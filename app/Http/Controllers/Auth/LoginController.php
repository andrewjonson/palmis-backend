<?php

namespace App\Http\Controllers\Auth;


use Carbon\Carbon;
use App\Traits\Auth\OtpTrait;
use App\Traits\ResponseTrait;
use App\Traits\Auth\LoginTrait;
use App\Traits\Auth\CaptchaTrait;
use App\Traits\Auth\TwoFactorTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use App\Traits\Auth\VerificationTrait;
use App\Http\Requests\Auth\LoginRequest;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use App\Repositories\Interfaces\LoginAttemptRepositoryInterface;

class LoginController extends Controller
{
    use ResponseTrait, LoginTrait, CaptchaTrait, VerificationTrait, OtpTrait, TwoFactorTrait;

    public function __construct(
        UserRepositoryInterface $userRepository,
        SettingRepositoryInterface $settingRepository,
        LoginAttemptRepositoryInterface $loginAttemptRepository
    ) 
    {
        $this->userRepository = $userRepository;
        $this->settingRepository = $settingRepository;
        $this->loginAttemptRepository = $loginAttemptRepository;
    }

    public function login(LoginRequest $request)
    {
        $client = Http::post(config('passport.personal_access_client.endpoint'), [
            'client_secret' => config('passport.personal_access_client.secret'),
            'grant_type' => 'password',
            'client_id' => config('passport.personal_access_client.id'),
            'username' => $request->email,
            'password' => $request->password
        ]);

        try {
            $settings = $this->settingRepository->first();
            $captchaLoginAttempts = $settings->captcha_login_attempts;
            $maxLoginAttempts = $settings->max_login_attempts;
            $user = $this->userRepository->getUserByEmail($request->email);
            
            if ($user) {  
                if ($user->deleted_at) {
                    return $this->failedResponse(trans('auth.deleted'), UNAUTHORIZED_USER);
                }

                if ($this->unblockable($user)) {
                    $this->unblock($user);
                } 

                if ($this->countLoginAttempts($user) >= $captchaLoginAttempts) {
                    $validator = $this->captchaValidator($user);
                    if ($validator->fails()) {
                        $this->throttleLoginAttempts($user);
                        if ($this->countLoginAttempts($user) >= $maxLoginAttempts) {
                            return $this->block($user);
                        }
                        $count = $maxLoginAttempts - $this->countLoginAttempts($user);
                        return $this->captchaResponse(trans('auth.invalid_captcha', ['count' => $count]), UNAUTHORIZED_USER);
                    }
                }

                if ($client->status() == 400) {
                    $this->throttleLoginAttempts($user);
                    $totalLoginAttempts = $this->countLoginAttempts($user);
                    $count = $maxLoginAttempts - $totalLoginAttempts;
                    
                    if ($totalLoginAttempts >= $maxLoginAttempts) {
                        return $this->block($user);
                    }
                    
                    if ($totalLoginAttempts >= $captchaLoginAttempts) {
                        return $this->captchaResponse(trans('auth.invalid_password', ['count' => $count]), UNAUTHORIZED_USER);
                    }
                    return $this->failedResponse(trans('auth.invalid_password', ['count' => $count]), UNAUTHORIZED_USER);
                }

                if ($this->countLoginAttempts($user) >= $maxLoginAttempts) {
                    return $this->block($user);
                }

                if (!$user->email_verified_at) {
                    return $this->emailNotVerifiedResponse($user);
                }

                if ($user->otp_auth) {
                    return $this->otpResponse($user);
                } elseif ($user->two_factor_secret) {
                    return $this->twoFactorResponse($user);
                }
                
                return $this->loginResponse($user, $client->json('access_token'));
            }
            return $this->failedResponse(trans('auth.invalid_credentials'), UNAUTHORIZED_USER);
        } catch(Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }
}