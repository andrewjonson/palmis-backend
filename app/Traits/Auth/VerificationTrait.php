<?php
namespace App\Traits\Auth;

trait VerificationTrait
{
    public function emailNotVerifiedResponse($user) 
    {
        return response()->json([
            'type' => 1,
            'email' => $user->email,
            'email_verified_at' => null,
            'token' => sha1($user->email)
        ], DATA_OK);
    }
}