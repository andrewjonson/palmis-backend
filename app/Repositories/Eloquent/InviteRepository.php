<?php
namespace App\Repositories\Eloquent;

use App\Models\Invite;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\InviteRepositoryInterface;

class InviteRepository extends BaseRepository implements InviteRepositoryInterface
{
    public function __construct(Invite $model)
    {
        $this->model = $model;
    }

    public function deleteByEmail($email)
    {
        $this->model->where('email', $email)->delete();
    }
}