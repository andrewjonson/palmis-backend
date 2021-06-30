<?php
namespace App\Traits\Users;

trait UsersTrait
{
    public function invalidPasswordResponse($user) 
    {
        $this->throttleLoginAttempts($user);
        $maxAttempts = $this->settingRepository->first()->max_login_attempts;
        $totalLoginAttempts = $this->countLoginAttempts($user);

        if ($totalLoginAttempts >= $maxAttempts) {
            return $this->block($user);
        }

        $counter = $maxAttempts - $totalLoginAttempts;
        return response()->json([
            'type' => 2,
            'message' => trans('users.incorrect_password_response', ['counter' => $counter])
        ], 403);
    }

    public function invalidPinResponse($user) 
    {
        $this->throttleLoginAttempts($user);
        $maxAttempts = $this->settingRepository->first()->max_login_attempts;
        $totalLoginAttempts = $this->countLoginAttempts($user);

        if ($totalLoginAttempts >= $maxAttempts) {
            $this->userRepository->update([
                'screen_lock' => false
            ]);
            return $this->block($user);
        }

        $counter = $maxAttempts - $totalLoginAttempts;
        return response()->json([
            'type' => 2,
            'message' => trans('users.incorrect_pin', ['counter' => $counter])
        ], 403);
    }
}