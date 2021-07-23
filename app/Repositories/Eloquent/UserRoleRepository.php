<?php
namespace App\Repositories\Eloquent;

use App\Models\UserRole;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\UserRoleRepositoryInterface;

class UserRoleRepository extends BaseRepository implements UserRoleRepositoryInterface
{
    public function __construct(UserRole $model)
    {
        $this->model = $model;
    }

    public function unAssignRoles(array $roleId, $userId)
    {
        $this->model->whereNotIn('role_id', $roleId)->where('user_id', $userId)->orWhereIn('role_id', $roleId)->delete();
    }
}