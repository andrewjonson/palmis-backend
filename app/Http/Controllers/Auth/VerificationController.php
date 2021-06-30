<?php

namespace App\Http\Controllers\Auth;

use Exception;
use App\Events\Verified;
use App\Traits\ResponseTrait;
use App\Traits\Auth\LoginTrait;
use App\Traits\ValidateUrlTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Users\SetupAccountRequest;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use Illuminate\Auth\Access\AuthorizationException;
use App\Notifications\EmailVerificationNotification;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\Interfaces\InviteRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use App\Repositories\Interfaces\PersonnelRepositoryInterface;
use App\Repositories\Interfaces\LoginAttemptRepositoryInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class VerificationController extends Controller
{
    use ResponseTrait, LoginTrait, ValidateUrlTrait;

    public function __construct(
        UserRepositoryInterface $userRepository,
        SettingRepositoryInterface $settingRepository,
        LoginAttemptRepositoryInterface $loginAttemptRepository,
        PersonnelRepositoryInterface $personnelRepository,
        InviteRepositoryInterface $inviteRepository
    ) 
    {
        $this->userRepository = $userRepository;
        $this->settingRepository = $settingRepository;
        $this->loginAttemptRepository = $loginAttemptRepository;
        $this->personnelRepository = $personnelRepository;
        $this->inviteRepository = $inviteRepository;
    }

    public function verify($email, $token) 
    {
        $user = $this->userRepository->getUserByEmail($email);
        if (!$email || !$token) {
            throw new AuthorizationException;
        }

        if (!$this->validUrl() || !hash_equals((string) $token, sha1($email))) {
            throw new NotFoundHttpException;
        }

        if (!$user) {
            return response()->json([
                'invited' => true,
                'token' => $token,
                'email' => $email
            ], 200);
        }

        if ($user->email_verified_at) {
            return $this->successResponse(trans('auth.verified'), 200);
        }

        try {
            event(new Verified($user));
            return $this->loginResponse($user);
        } catch(Exception $e) {
            return $this->failedResponse($e->getMessage(), 500);
        }
    }

    public function resendEmailVerification(ForgotPasswordRequest $request)
    {
        $user = $this->userRepository->getUserByEmail($request->email);
        if (!$user) {
            throw new AuthorizationException;
        }

        if (!hash_equals((string) $request->token, sha1($user->email))) {
            throw new BadRequestException;
        }

        try {
            if ($user->email_verified_at == null) {
                $user->notify(new EmailVerificationNotification($this->settingRepository->first()));
                return $this->successResponse(trans('auth.email_verification_sent'), 200);
            }
            return $this->successResponse(trans('auth.verified'), 200);
        } catch(Exception $e) {
            return $this->failedResponse($e->getMessage(), 500);
        }
    }

    public function setupAccount(SetupAccountRequest $request)
    {
        try {
            if (! hash_equals((string) $request->token, sha1($request->email))) {
                return $this->failedResponse(trans('auth.bad_request'), 400);
                throw new BadRequestException;
            }

            $afpsn = $request->afpsn;
            $birthday = $request->birthday;
            $validateUser = $this->personnelRepository->validateAfpsnBirthday($afpsn, $birthday);
            if (!$validateUser) {
                return $this->failedResponse(trans('auth.invalid_user'), 403);
            }

            $request['password'] = Hash::make($request->password);
            $this->inviteRepository->deleteByEmail($request->email);
            $user = $this->userRepository->create($request->all());
            event(new Verified($user));
            return $this->loginResponse($user);
        } catch(Exception $e) {
            return $this->failedResponse($e->getMessage(), 500);
        }
    }
}
