<?php

namespace App\Http\Controllers\Auth;

use Exception;
use App\Traits\ResponseTrait;
use App\Traits\Auth\LoginTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\TwoFactorAuthRequest;
use Illuminate\Auth\Access\AuthorizationException;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use App\Repositories\Interfaces\LoginAttemptRepositoryInterface;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class TwoFactorController extends Controller
{
    use LoginTrait, ResponseTrait;

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

    public function store(TwoFactorAuthRequest $request)
    {
        if (!hash_equals((string) $request->token, sha1($request->email))) {
            throw new BadRequestException;
        }
        
        try {
            $user = $this->userRepository->getUserByEmail($request->email);
            if (!$user->auth_type) {
                throw new AuthorizationException;
            }

            if ($code = $request->validRecoveryCode($user)) {
                $user->replaceRecoveryCode($code);
            } 
            elseif (! $request->hasValidCode($user)) {
                return $this->invalidCodeResponse($user);
            }

            return $this->loginResponse($user);
        } catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), 401);
        }
    }
}