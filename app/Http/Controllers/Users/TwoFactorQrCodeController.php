<?php

namespace App\Http\Controllers\Users;

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

class TwoFactorQrCodeController extends Controller
{
    use ResponseTrait, UsersTrait, LoginTrait;

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
     * Get the SVG element for the user's two factor authentication QR code.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function show(ConfirmPasswordRequest $request)
    {
        if (! $request->user()->two_factor_secret) {
            return $this->failedResponse(trans('users.2fa_disabled'), FORBIDDEN);
        }
        if (Hash::check($request->password, $request->user()->password)) {
            $this->resetLoginattempts($request->user());
            return response()->json([
                'type' => 1,
                'svg' => $request->user()->twoFactorQrCodeSvg()
            ], DATA_OK);
        }

        return $this->invalidPasswordResponse($request->user());
    }
}