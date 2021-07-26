<?php
namespace App\Repositories\Eloquent;

use App\Models\RolePermission;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\RolePermissionRepositoryInterface;

class RolePermissionRepository extends BaseRepository implements RolePermissionRepositoryInterface
{
    public function __construct(RolePermission $model)
    {
        $this->model = $model;
    }
}