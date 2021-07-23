<?php

namespace App\Http\Controllers\Users;

use Exception;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Traits\Auth\LoginTrait;
use App\Traits\Users\UsersTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Users\ConfirmPasswordRequest;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use App\Repositories\Interfaces\LoginAttemptRepositoryInterface;
use App\Services\TwoFactorAuthentication\Actions\EnableTwoFactorAuthentication;
use App\Services\TwoFactorAuthentication\Actions\DisableTwoFactorAuthentication;

class TwoFactorAuthenticationController extends Controller
{
    use ResponseTrait, LoginTrait, UsersTrait;

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

    /**
     * Enable two factor authentication for the user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Laravel\Fortify\Actions\EnableTwoFactorAuthentication  $enable
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function store(ConfirmPasswordRequest $request, EnableTwoFactorAuthentication $enable)
    {
        try {
            $user = auth()->user();
            $otpEnabled = $this->userRepository->otpEnabled($user->id);
            if ($otpEnabled) {
                return $this->failedResponse(trans('users.otp_already_enabled'), FORBIDDEN);
            }
            
            if (Hash::check($request->password, $user->password)) {
                $enable($user);
                $this->resetLoginattempts($user);
                return $this->successResponse(trans('users.2fa_enabled'), DATA_OK);
            } 
            return $this->invalidPasswordResponse($user);
        } catch(Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }

    /**
     * Disable two factor authentication for the user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Laravel\Fortify\Actions\DisableTwoFactorAuthentication  $disable
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function destroy(Request $request, DisableTwoFactorAuthentication $disable)
    {
        try {
            $disable($request->user());
            return $this->successResponse(trans('users.2fa_disabled'), DATA_OK);
        } catch(Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }
}