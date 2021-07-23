<?php

namespace App\Http\Controllers\Auth;

use Exception;
use App\Traits\ResponseTrait;
use App\Events\UserHasRegistered;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\RegisterRequest;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use App\Repositories\Interfaces\PersonnelRepositoryInterface;

class RegisterController extends Controller
{
    use ResponseTrait;

    public function __construct(
        UserRepositoryInterface $userRepository,
        PersonnelRepositoryInterface $personnelRepository,
        SettingRepositoryInterface $settingRepository
    )
    {
        $this->userRepository = $userRepository;
        $this->personnelRepository = $personnelRepository;
        $this->settingRepository = $settingRepository;
    }

    public function register(RegisterRequest $request)
    {
        try {
            $afpsn = $request->afpsn;
            $birthday = $request->birthday;
            $validateUser = $this->personnelRepository->validateAfpsnBirthday($afpsn, $birthday);

            if (!$validateUser) {
                return $this->failedResponse(trans('auth.invalid_user'), BAD_REQUEST);
            }

            $request['password'] = Hash::make($request->password);
            event(new UserHasRegistered($user = $this->userRepository->create($request->all()), $this->settingRepository->first()));
            $this->userRepository->update([
                'created_by' => $user->id
            ], $user->id);
            return response()->json([
                'type' => 1,
                'token' => sha1($user->email),
                'email' => $user->email,
                'email_verified_at' => $user->email_verified_at,
                'message' => trans('auth.registered')
            ], 201);
        } catch(Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }
}