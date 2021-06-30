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
use App\Services\TwoFactorAuthentication\Actions\GenerateNewRecoveryCodes;

class RecoveryCodeController extends Controller
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
     * Get the two factor authentication recovery codes for authenticated user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(ConfirmPasswordRequest $request)
    {
        if (! $request->user()->two_factor_secret ||
            ! $request->user()->two_factor_recovery_codes) {
            return $this->failedResponse(trans('users.2fa_disabled'), 403);
        }

        if (Hash::check($request->password, $request->user()->password)) {
            $this->resetLoginattempts($request->user());
            return response()->json([
                'type' => 1,
                'message' =>
                json_decode(decrypt(
                    $request->user()->two_factor_recovery_codes
                ), true)
            ], 200);
        }

        return $this->invalidPasswordResponse($request->user());
    }

    /**
     * Generate a fresh set of two factor authentication recovery codes.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Laravel\Fortify\Actions\GenerateNewRecoveryCodes  $generate
     * @return \Illuminate\Http\Response
     */
    public function store(ConfirmPasswordRequest $request, GenerateNewRecoveryCodes $generate)
    {
        if (! $request->user()->two_factor_secret) {
            return $this->failedResponse(trans('users.2fa_disabled'), 403);
        }

        if (Hash::check($request->password, $request->user()->password)) {
            $generate($request->user());
            $this->resetLoginattempts($request->user());
            return $this->successResponse(trans('users.regenerate_recovery_codes'), 200);
        }

        return $this->invalidPasswordResponse($request->user());
    }
}