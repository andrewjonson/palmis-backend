<?php
namespace App\Repositories\Eloquent;

use App\Models\OldPassword;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\OldPasswordRepositoryInterface;

class OldPasswordRepository extends BaseRepository implements OldPasswordRepositoryInterface
{
    public function __construct(OldPassword $model)
    {
        $this->model = $model;
    }

    public function getOldPasswordsByUserId($user_id)
    {
        return $this->model->where('user_id', $user_id)->get();
    }

    public function deleteLastOldPassword($user_id)
    {
        $this->model->where('user_id', $user_id)->orderBy('id')->first()->delete();
    }

    public function checkOldPassword($oldPassword)
    {
        $this->model->where('old_password', $oldPassword)->first();
    }
}