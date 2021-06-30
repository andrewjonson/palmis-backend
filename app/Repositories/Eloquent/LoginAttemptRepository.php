<?php
namespace App\Repositories\Eloquent;

use App\Models\LoginAttempt;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\LoginAttemptRepositoryInterface;

class LoginAttemptRepository extends BaseRepository implements LoginAttemptRepositoryInterface
{
    public function __construct(LoginAttempt $model)
    {
        $this->model = $model;
    }

    public function getLoginAttempts($user)
    {
        return $this->model->where('email', $user->email)->paginate();
    }

    public function deleteLoginAttempts($user)
    {
        return $this->model->where('email', $user->email)->delete();
    }
}