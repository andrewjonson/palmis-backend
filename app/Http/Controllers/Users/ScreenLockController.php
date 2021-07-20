<?php

namespace App\Http\Controllers\Users;

use Exception;
use App\Traits\ResponseTrait;
use App\Traits\Auth\LoginTrait;
use App\Traits\Users\UsersTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Users\PinRequest;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use App\Repositories\Interfaces\LoginAttemptRepositoryInterface;

class ScreenLockController extends Controller
{
    use UsersTrait, LoginTrait, ResponseTrait;

    public function __construct(
        LoginAttemptRepositoryInterface $loginAttemptRepository,
        SettingRepositoryInterface $settingRepository,
        UserRepositoryInterface $userRepository,
    )
    {
        $this->loginAttemptRepository = $loginAttemptRepository;
        $this->settingRepository = $settingRepository;
        $this->userRepository = $userRepository;
    }

    public function enable(PinRequest $request)
    {
        $user = auth()->user();
        if (!$user->pin) {
            $pin = $this->userRepository->update([
                'pin' => Hash::make($request->pin)
            ], $user->id);

            if (!Hash::check($request->current_password, $user->password)) {
                return $this->invalidPasswordResponse($user);
            }
        }

        try {
            $this->resetLoginAttempts($user);
            $this->userRepository->update([
                'screen_lock' => true
            ], $user->id);
            return response()->json([
                'type' => 1,
                'message' => trans('users.screenlock_enabled'),
                'screen_lock' => true
            ]);
        } catch (Exception $e) {
            return $this->failedResponse($e->getMessage(), 500);
        }
    }

    public function disable(PinRequest $request)
    {
        $user = auth()->user();
        if (!Hash::check($request->pin, $user->pin)) {
            return $this->invalidPinResponse($user);
        }

        try {
            $this->resetLoginAttempts($user);
            $this->userRepository->update([
                'screen_lock' => false
            ], $user->id);
            return response()->json([
                'type' => 1,
                'message' => trans('users.screenlock_disabled'),
                'screen_lock' => false
            ]);
        } catch (Exception $e) {
            return $this->failedResponse($e->getMessage(), 500);
        }
    }
}
