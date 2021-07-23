<?php
namespace App\Traits\Auth;

trait TwoFactorTrait
{
    public function twoFactorResponse($user) 
    {
        $this->resetLoginAttempts($user);
        $this->userRepository->update([
            'auth_type' => 2,
            'auth_status' => false
        ], $user->id);
        return response()->json([
            'type' => 1,
            'token' => sha1($user->email),
            'email' => $user->email,
            'message' => trans('auth.two_factor'),
            'auth_type' => 2
        ], DATA_OK);
    }
}