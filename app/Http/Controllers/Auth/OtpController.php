<?php

namespace App\Http\Controllers\Auth;

use Exception;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Traits\Auth\LoginTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\OtpRequest;
use App\Notifications\OtpEmailNotification;
use Illuminate\Auth\Access\AuthorizationException;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use App\Repositories\Interfaces\LoginAttemptRepositoryInterface;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class OtpController extends Controller
{
    use LoginTrait, ResponseTrait;

    public function __construct(
        SettingRepositoryInterface $settingRepository,
        LoginAttemptRepositoryInterface $loginAttemptRepository,
        UserRepositoryInterface $userRepository
    )
    {
        $this->settingRepository = $settingRepository;
        $this->loginAttemptRepository = $loginAttemptRepository;
        $this->userRepository = $userRepository;
    }

    public function otpChallenge(OtpRequest $request) 
    {
        if (!hash_equals((string) $request->token, sha1($request->email))) {
            throw new BadRequestException;
        }

        try {
            $user = $this->userRepository->getUserByEmail($request->email);
            if ($request->otp_code != $user->otp_code) {
                return $this->invalidCodeResponse($user);
            } elseif (Carbon::now() >= $user->otp_expire_at) {
                $user->update([
                    'auth_type' => null
                ]);
                return response()->json([
                    'type' => 2,
                    'message' => trans('auth.otp_expired')
                ]);
            }
            return $this->loginResponse($user);
        } catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }

    public function resendOtp(Request $request) 
    {
        if (!hash_equals((string) $request->token, sha1($request->email))) {
            throw new AuthorizationException;
        }

        try {
            $user = $this->userRepository->getUserByEmail($request->email);
            if ($user->auth_status) {
                throw new AuthorizationException;
            }

            $user->notify(new OtpEmailNotification($this->settingRepository->first()));
            return response()->json([
                'type' => 1,
                'message' => trans('auth.resend_otp')
            ]);
        } catch(Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }

    public function enableOtp(Request $request)
    {
        try {
            $user = auth()->user();
            if ($user) {
                if (!$user->two_factor_secret) {
                    $this->userRepository->enableOtp($request->user_id);
                    return $this->successResponse(trans('auth.otp_enabled'), DATA_OK);
                }
                return $this->failedResponse(trans('users.2fa_already_enabled'), FORBIDDEN);
            }
            throw new AuthorizationException;
        } catch(Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }

    public function disableOtp(Request $request)
    {
        try {
            $user = auth()->user();
            $this->userRepository->disableOtp($request->user_id);
            return $this->successResponse(trans('auth.otp_disabled'), DATA_OK);
        } catch(Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }
}