<?php

namespace App\Http\Controllers\Auth;

use Exception;
use App\Events\ResetPassword;
use App\Traits\ResponseTrait;
use App\Traits\ValidateUrlTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\Interfaces\OldPasswordRepositoryInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ResetPasswordController extends Controller
{
    use ResponseTrait, ValidateUrlTrait;

    public function __construct(
        UserRepositoryInterface $userRepository,
        OldPasswordRepositoryInterface $oldPasswordRepository
    ) 
    {
        $this->userRepository = $userRepository;
        $this->oldPasswordRepository = $oldPasswordRepository;
    }

    public function showResetForm($token, $email)
    {
        if (!$this->validUrl() || !$token || !$email) {
            throw new NotFoundHttpException;
        }
    }

    public function reset(ResetPasswordRequest $request)
    {
        try {
            $user = $this->userRepository->getUserByEmail($request->email);
            if (!$user) {
                return $this->failedResponse(trans('auth.incorrect_email'), 400);
            }

            event(new ResetPassword($user));
            $response = $this->broker()->reset(
                $this->credentials($request), function ($user, $password) {
                    $this->resetPassword($user, $password);
                }
            );

            return $response == Password::PASSWORD_RESET
                        ? $this->sendResetResponse($response)
                        : $this->sendResetFailedResponse($response);
        } catch(Exception $e) {
            $this->failedResponse($e->getMessage(), 500);
        }
    }

    /**
     * Get the password reset credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(ResetPasswordRequest $request)
    {
        return $request->only(
            'email', 'password', 'password_confirmation', 'token'
        );
    }

    /**
     * Reset the given user's password.
     *
     * @param  \Illuminate\Contracts\Auth\CanResetPassword  $user
     * @param  string  $password
     * @return void
     */
    protected function resetPassword($user, $password)
    {
        $this->setUserPassword($user, $password);

        $user->save();

        event(new PasswordReset($user)); 
    }

    /**
     * Set the user's password.
     *
     * @param  \Illuminate\Contracts\Auth\CanResetPassword  $user
     * @param  string  $password
     * @return void
     */
    protected function setUserPassword($user, $password)
    {
        $user->password = Hash::make($password);
    }

    protected function sendResetResponse($response)
    {
        return response()->json([
            'type' => 1,
            'message' => trans($response)
        ], 200);
    }

    protected function sendResetFailedResponse($response)
    {
        return response()->json([
            'type' => 2,
            'message' => trans($response)
        ], 400);
    }

    /**
     * Get the broker to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\PasswordBroker
     */
    public function broker()
    {
        return Password::broker();
    }

    /**
     * Get the guard to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }
}