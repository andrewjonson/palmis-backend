<?php

namespace App\Http\Controllers\Auth;

use Exception;
use App\Traits\ResponseTrait;
use App\Events\UserHasRegistered;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\Auth\RegisterRequest;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use App\Services\ApiService\v1\MpisService\Transactions\Personnel;

class RegisterController extends Controller
{
    use ResponseTrait;

    public function __construct(
        UserRepositoryInterface $userRepository,
        Personnel $personnelService,
        SettingRepositoryInterface $settingRepository,
    )
    {
        $this->userRepository = $userRepository;
        $this->personnelService = $personnelService;
        $this->settingRepository = $settingRepository;
    }

    public function register(RegisterRequest $request)
    {
        try {
            $serialNumber = $request->serial_number;
            $birthday = $request->birthday;
            $validateUser = Http::get(config('services.mpis_base_uri').'/api/'.config('app.version').'/mpis/search-serial-birth', $request->all());
            if ($validateUser->status() != DATA_OK) {
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