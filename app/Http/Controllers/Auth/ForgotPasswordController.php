<?php

namespace App\Http\Controllers\Auth;

use Exception;
use App\Traits\ResponseTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use App\Repositories\Interfaces\UserRepositoryInterface;

class ForgotPasswordController extends Controller
{
    use ResponseTrait;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function sendResetLink(ForgotPasswordRequest $request)
    {
        try {
            $user = $this->userRepository->getUserByEmail($request->email);
            if ($user) {
                if (!is_null($user->email_verified_at)) {
                    $response = $this->broker()->sendResetLink($request->only('email'));
                    return $response == Password::RESET_LINK_SENT
                                ? $this->sendResetLinkResponse($response)
                                : $this->sendResetLinkFailedResponse($response);
                }
                return $this->failedResponse(trans('auth.not_verified'), 400);
            }
            return $this->sendResetLinkFailedResponse(trans('passwords.user'));
        } catch(Exception $e) {
            return $this->failedResponse($e->getMessage(), 500);
        }
    }

    protected function sendResetLinkResponse($response)
    {
        return response()->json([
            'type' => 1,
            'message' => trans($response)
        ], 200);
    }

    protected function sendResetLinkFailedResponse($response)
    {
        return response()->json([
            'type' => 2,
            'message' => trans($response)
        ], 400);
    }

    public function broker()
    {
        return Password::broker();
    }
}
