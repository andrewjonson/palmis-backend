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
            'apiToken' => auth()->tokenById($user->id)
        ], 200);
    }
}