<?php
namespace App\Traits\Auth;

use Carbon\Carbon;

trait LoginTrait
{
    public function loginResponse($user, $token) 
    {
        $this->resetLoginAttempts($user);
        $user = $this->userRepository->update([
            'auth_type' => null,
            'auth_status' => true,
            'screen_lock' => false
        ], $user->id);
        return response()->json([
            'type' => 1,
            'user' => [
                'id' => $user->id,
                'email' => $user->email,
                'status' => $user->auth_status ? 'Online' : 'Offline'
            ],
            'token' => $token,
            'message' => trans('auth.logged_in'),
            'auth_type' => $user->auth_status,
        ], DATA_OK);
    }

    public function throttleLoginAttempts($user)
    {
        $this->loginAttemptRepository->create([
            'email' => $user->email,
            'ip_address' => request()->ip()
        ]);
    }

    public function countLoginAttempts($user)
    {
        $loginAttempts = $this->loginAttemptRepository->getLoginAttempts($user);
        return count($loginAttempts);
    }

    public function resetLoginAttempts($user) 
    {
        return $this->loginAttemptRepository->deleteLoginAttempts($user);
    }

    public function unblockable($user) 
    {
        if ($user->blocked_at != NULL) {
            if (Carbon::now() >= $user->blocked_at) {
                return true;
            } 
        } 
    }

    public function unblock($user) 
    {
        if ($user->blocked_at !== NULL) {
            $user = $this->userRepository->update([
                'blocked_at' => NULL
            ], $user->id);
        }

        $this->resetLoginAttempts($user);
    }

    public function block($user) 
    {
        if ($user->blocked_at == NULL) {
            $blockedTimestamp = Carbon::parse($user->blocked_at)->addMinute($this->settingRepository->first()->block_duration);
            $user = $this->userRepository->update([
                'blocked_at' => $blockedTimestamp,
                'auth_status' => false,
                'auth_type' => null
            ], $user->id);
        }

        $auth = auth();
        if ($auth->user()) {
            $auth->invalidate();
        }
        
        $blockedTimeLimit = Carbon::now()->diffInSeconds($user->blocked_at);
        return $this->failedResponse(trans('auth.blocked', ['blockedTimeLimit' => $blockedTimeLimit]), UNAUTHORIZED_USER);
    }

    public function invalidCodeResponse($user) 
    {
        $this->throttleLoginAttempts($user);
        $max_attempts = $this->settingRepository->first()->max_login_attempts;
        $total_login_attempts = $this->countLoginAttempts($user);

        if ($total_login_attempts >= $max_attempts) {
            return $this->block($user);
        }

        $count = $max_attempts - $total_login_attempts;
        return response()->json([
            'type' => 2,
            'message' => trans('auth.incorrect_code', ['count' => $count])
        ], FORBIDDEN);
    }
}