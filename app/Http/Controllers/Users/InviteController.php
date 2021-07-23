<?php

namespace App\Http\Controllers\Users;

use Exception;
use App\Traits\ResponseTrait;
use App\Events\UserHasRegistered;
use App\Http\Controllers\Controller;
use App\Http\Resources\InviteResource;
use App\Http\Requests\Users\InviteRequest;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\Interfaces\InviteRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;

class InviteController extends Controller
{
    use ResponseTrait;

    public function __construct(
        InviteRepositoryInterface $inviteRepository,
        SettingRepositoryInterface $settingRepository,
        UserRepositoryInterface $userRepository
    )
    {
        $this->inviteRepository = $inviteRepository;
        $this->settingRepository = $settingRepository;
        $this->userRepository = $userRepository;
    }

    public function invite(InviteRequest $request)
    {
        try {
            $user = $this->userRepository->getUserByEmail($request->email);
            if ($user) {
                return $this->failedResponse(trans('users.user_already_registered'), BAD_REQUEST);
            }
            event(new UserHasRegistered($this->inviteRepository->create($request->all()), $this->settingRepository->first()));
            return $this->successResponse(trans('users.invited'), DATA_OK);
        } catch(Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }

    public function showInvites()
    {
        try {
            $invites = $this->inviteRepository->paginate();
            return InviteResource::collection($invites);
        } catch(Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }
}