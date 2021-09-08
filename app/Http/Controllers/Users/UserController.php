<?php

namespace App\Http\Controllers\Users;

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
use App\Http\Resources\AccountTypeResource;
use App\Http\Resources\LoginAttemptResource;
use App\Http\Requests\Users\ChangePasswordRequest;
use Illuminate\Auth\Access\AuthorizationException;
use App\Notifications\EmailVerificationNotification;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\Interfaces\InviteRepositoryInterface;
use App\Repositories\Interfaces\ModuleRepositoryInterface;
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
        OldPasswordRepositoryInterface $oldPasswordRepository,
        ModuleRepositoryInterface $moduleRepository
    )
    {
        $this->userRepository = $userRepository;
        $this->inviteRepository = $inviteRepository;
        $this->settingRepository = $settingRepository;
        $this->personnelRepository = $personnelRepository;
        $this->loginAttemptRepository = $loginAttemptRepository;
        $this->oldPasswordRepository = $oldPasswordRepository;
        $this->moduleRepository = $moduleRepository;
    }

    public function index(Request $request)
    {
        try {
            $keyword = $request->keyword;
            $rowsPerPage = $request->rowsPerPage;
            $users = $this->userRepository->search($keyword, $rowsPerPage);
            return UserResource::collection($users);
        } catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }

    public function currentUser()
    {
        try {
            $user = auth()->user();
            return new UserResource($user);
        } catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }

    public function show($userId)
    {
        try {
            $userId = hashid_decode($userId);
            $user = $this->userRepository->find($userId);
            return new UserResource($user);
        } catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }

    public function update(UserRequest $request, $userId)
    {
        $userId = hashid_decode($userId);
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
                'serial_number' => $user->serial_number,
                'email_verified_at' => $currentEmail
                            ? $user->email_verified_at : null,
                'two_factor_secret' => $currentEmail
                            ? $user->token_factor_secret : null,
                'two_factor_recovery_codes' => $currentEmail
                            ? $user->two_factor_recovery_codes : null,
            ], $userId);
            if ($currentUser->id == $userId && !$user->email_verified_at) {
                auth()->invalidate();
                return response()->json([
                    'type' => 1,
                    'message' => trans('users.email_updated'),
                    'logout' => true
                ]);
            }

            return response()->json([
                'type' => 1,
                'message' => trans('users.user_updated'),
                'data' => new UserResource($user)
            ]);
        } catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }

    public function assignSuperAdmin(Request $request, $userId)
    {
        try {
            $userId = hashid_decode($userId);
            $user = $this->userRepository->find($userId);
            if (!$user) {
                throw new AuthorizationException;
            }

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
            return $this->successResponse(trans('users.assign_success'), DATA_OK);
        } catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
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
                return $this->failedResponse(trans('users.old_password'), BAD_REQUEST);
            }
        }

        try {
            $user = $this->userRepository->update([
                'password' => Hash::make($request->password)
            ], $user->id);
            event(new ResetPassword($user));
            $this->resetLoginAttempts($user);
            auth()->invalidate();
            return $this->successResponse(trans('users.password_changed'), DATA_OK);
        } catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }

    public function softDelete($userId)
    {
        $userId = hashid_decode($userId);
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
            return $this->successResponse(trans('users.soft_deleted'), DATA_OK);
        } catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }

    public function onlyTrashed(Request $request)
    {
        try {
            $keyword = $request->keyword;
            $rowsPerPage = $request->rowsPerPage;
            $users = $this->userRepository->onlyTrashed($keyword, $rowsPerPage);
            return UserResource::collection($users);
        } catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }

    public function restore($userId)
    {
        $userId = hashid_decode($userId);
        $user = $this->userRepository->onlyTrashedById($userId);
        if (!$user) {
            throw new AuthorizationException;
        }

        try {
            $user->restore();
            return $this->successResponse(trans('users.restored'), DATA_OK);
        } catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }

    public function forceDelete($userId)
    {
        $userId = hashid_decode($userId);
        $user = $this->userRepository->onlyTrashedById($userId);
        if (!$user) {
            throw new AuthorizationException;
        }

        try {
            $user->forceDelete();
            return $this->successResponse(trans('users.force_deleted'), DATA_OK);
        } catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }

    public function showLoginAttempts(Request $request)
    {
        $keyword = $request->keyword;
        $rowsPerPage = $request->rowsPerPage;
        try {
            $loginAttempts = $this->loginAttemptRepository->search($keyword, $rowsPerPage);
            return LoginAttemptResource::collection($loginAttempts);
        } catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }

    public function accountType($userId)
    {
        $userId = hashid_decode($userId);
        $user = $this->userRepository->find($userId);
        if (!$user) {
            throw new AuthorizationException;
        }
        try {
            return new AccountTypeResource($user, $this->moduleRepository);
        } catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }

    public function validatePassword(ValidatePasswordRequest $request)
    {
        $user = auth()->user();
        if (!Hash::check($request->current_password, $user->password)) {
            return $this->invalidPasswordResponse($user);
        }
    }
}
