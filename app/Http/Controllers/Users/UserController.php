<?php

namespace App\Http\Controllers\Users;

use Exception;
use Illuminate\Http\Request;
use App\Events\ResetPassword;
use App\Traits\ResponseTrait;
use App\Traits\Auth\LoginTrait;
use App\Traits\Users\UsersTrait;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\Users\UserRequest;
use App\Http\Requests\Users\ChangePasswordRequest;
use Illuminate\Auth\Access\AuthorizationException;
use App\Notifications\EmailVerificationNotification;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\Interfaces\InviteRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use App\Repositories\Interfaces\PersonnelRepositoryInterface;
use App\Repositories\Interfaces\OldPasswordRepositoryInterface;
use App\Repositories\Interfaces\LoginAttemptRepositoryInterface;

class UserController extends Controller
{
    use ResponseTrait, UsersTrait, LoginTrait;

    public function __construct(
        UserRepositoryInterface $userRepository,
        InviteRepositoryInterface $inviteRepository,
        SettingRepositoryInterface $settingRepository,
        PersonnelRepositoryInterface $personnelRepository,
        LoginAttemptRepositoryInterface $loginAttemptRepository,
        OldPasswordRepositoryInterface $oldPasswordRepository
    )
    {
        $this->userRepository = $userRepository;
        $this->inviteRepository = $inviteRepository;
        $this->settingRepository = $settingRepository;
        $this->personnelRepository = $personnelRepository;
        $this->loginAttemptRepository = $loginAttemptRepository;
        $this->oldPasswordRepository = $oldPasswordRepository;
    }

    public function index(Request $request)
    {
        try {
            $keyword = $request->keyword;
            $rowsPerPage = $request->rowsPerPage;
            $users = $this->userRepository->search($keyword, $rowsPerPage);
            return UserResource::collection($users);
        } catch(Exception $e) {
            return $this->failedResponse($e->getMessage(), 500);
        }
    }

    public function currentUser()
    {
        try {
            $user = auth()->user();
            return new UserResource($user);
        } catch(Exception $e) {
            return $this->failedResponse($e->getMessage(), 500);
        }
    }

    public function show($userId)
    {
        try {
            $user = $this->userRepository->find($userId);
            return new UserResource($user);
        } catch(Exception $e) {
            return $this->failedResponse($e->getMessage(), 500);
        }
    }

    public function update(UserRequest $request, $userId)
    {
        $currentUser = auth()->user();
        $user = $this->userRepository->find($userId);
        if (!$user) {
            throw new AuthorizationException;
        }

        if (!$currentUser->is_superadmin) {
            if ($currentUser->id != $user->id) {
                throw new AuthorizationException;
            }
        }
        
        if (!Hash::check($request->current_password, $currentUser->password)) {
            return $this->invalidPasswordResponse($currentUser);
        }
        
        try {
            $validateUser = $this->personnelRepository->validateAfpsn($request->afpsn);
            if (!$validateUser) {
                return $this->failedResponse(trans('auth.invalid_user'), 400);
            }

            $this->resetLoginAttempts($user);
            if ($currentUser->is_superadmin) {
                $this->assignSuperAdmin($request, $userId);
            }

            $currentEmail = $request->email == $user->email;
            if (!$currentEmail) {
                $user->notify(new EmailVerificationNotification($this->settingRepository->first()));
            }

            $user = $this->userRepository->update([
                'email' => $request->email,
                'afpsn' => $request->afpsn,
                'email_verified_at' => $currentEmail
                            ? $user->email_verified_at : null,
            ], $userId);
            if ($currentUser->id == $userId && !$user->email_verified_at) {
                auth()->invalidate();
                return $this->successResponse(trans('users.email_updated'), 200);
            }

            return response()->json([
                'type' => 1,
                'message' => trans('users.user_updated'),
                'data' => new UserResource($user)
            ]);
        } catch(Exception $e) {
            return $this->failedResponse($e->getMessage(), 500);
        }
    }

    public function assignSuperAdmin(Request $request, $userId)
    {
        try {
            $user = $this->userRepository->find($userId);
            $isSuperAdmin = $request->isSuperadmin;
            if ($isSuperAdmin) {
                $user->update([
                    'is_superadmin' => true
                ]);
            }

            if ($user->is_superadmin) {
                if (!$isSuperAdmin) {
                    $user->update([
                        'is_superadmin' => false
                    ]);
                }
            }
        } catch(Exception $e) {
            return $this->failedResponse($e->getMessage(), 500);
        }
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $user = auth()->user();
        if (!Hash::check($request->current_password, $user->password)) {
            return $this->invalidPasswordResponse($user);
        }

        $oldPasswords = $this->oldPasswordRepository->getOldPasswordsByUserId($user->id);
        for ($i = 0; $i < count($oldPasswords); $i++) {
            if (Hash::check($request->password, $oldPasswords->pluck('old_password')[$i])) {
                return $this->failedResponse(trans('users.old_password'), 400);
            }
        }

        try {
            $user = $this->userRepository->update([
                'password' => Hash::make($request->password)
            ], $user->id);
            event(new ResetPassword($user));
            $this->resetLoginAttempts($user);
            auth()->invalidate();
            return $this->successResponse(trans('users.password_changed'), 200);
        } catch(Exception $e) {
            return $this->failedResponse($e->getMessage(), 500);
        }
    }

    public function softDelete($userId)
    {
        $currentUser = auth()->user();
        $user = $this->userRepository->find($userId);
        if (!$user || $currentUser->id == $userId) {
            throw new AuthorizationException;
        }

        if (!$currentUser->is_superadmin) {
            if ($currentUser->id != $userId) {
                throw new AuthorizationException;
            }
        }

        try {
            $user->delete();
            return $this->successResponse(trans('users.soft_deleted'), 200);
        } catch(Exception $e) {
            return $this->failedResponse($e->getMessage(), 500);
        }
    }

    public function onlyTrashed(Request $request)
    {
        try {
            $keyword = $request->keyword;
            $rowsPerPage = $request->rowsPerPage;
            $users = $this->userRepository->onlyTrashed($keyword, $rowsPerPage);
            return UserResource::collection($users);
        } catch(Exception $e) {
            return $this->failedResponse($e->getMessage(), 500);
        }
    }

    public function restore($userId)
    {
        $user = $this->userRepository->onlyTrashedById($userId);
        if (!$user) {
            throw new AuthorizationException;
        }

        try {
            $user->restore();
            return $this->successResponse(trans('users.restored'), 200);
        } catch(Exception $e) {
            return $this->failedResponse($e->getMessage(), 500);
        }
    }

    public function forceDelete($userId)
    {
        $user = $this->userRepository->onlyTrashedById($userId);
        if (!$user) {
            throw new AuthorizationException;
        }

        try {
            $user->forceDelete();
            return $this->successResponse(trans('users.force_deleted'), 200);
        } catch(Exception $e) {
            return $this->failedResponse($e->getMessage(), 500);
        }
    }
}
