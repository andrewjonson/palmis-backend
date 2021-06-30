<?php
namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function getUserByEmail($email)
    {
        return $this->model->where('email', $email)->first();
    }

    public function enableOtp(array $userId)
    {
        $this->model
            ->whereIn('id', $userId)
            ->update([
                'otp_auth' => true
            ]);
    }

    public function disableOtp(array $userId)
    {
        $this->model->whereIn('id', $userId)->update([
            'otp_auth' => false
        ]);
    }

    public function otpEnabled($userId)
    {
        return $this->model->where('id', $userId)->where('otp_auth', true)->first();
    }
}