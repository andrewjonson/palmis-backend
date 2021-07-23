<?php
namespace App\Traits\Auth;

use Carbon\Carbon;
use App\Notifications\OtpEmailNotification;

trait OtpTrait
{
    public function otpResponse($user) 
    {
        $this->resetLoginAttempts($user);
        $otpCode = $this->generateCode();
        $otpExpireAt = $this->setExpiration();
        $this->userRepository->update([
            'auth_type' => 1,
            'otp_code' => $otpCode,
            'otp_expire_at' => $otpExpireAt,
            'auth_status' => false
        ], $user->id);
        $user->notify(new OtpEmailNotification($this->settingRepository->first()));
        $num = '09123456789';
        $num_length = strlen($num);
        $mobile_number = substr($num, 0, 4).str_repeat('*', $num_length - 6).substr($num, $num_length - 2, 2);
        return response()->json([
            'type' => 1,
            'token' => sha1($user->email),
            'email' => $user->email,
            'mobile_number' => $mobile_number,
            'message' => trans('auth.otp_auth_response'),
            'auth_type' => 1
        ], DATA_OK);
    }

    protected function generateCode()
    {
        return str_pad(mt_rand(0, 999999), $this->settingRepository->first()->otp_digits, '0', STR_PAD_LEFT);
    }

    protected function setExpiration()
    {
        return Carbon::now()->addMinute($this->settingRepository->first()->otp_expiration);
    }
}