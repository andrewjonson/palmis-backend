<?php
namespace App\Repositories\Eloquent;

use App\Models\Permission;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\PermissionRepositoryInterface;

class PermissionRepository extends BaseRepository implements PermissionRepositoryInterface
{
    public function __construct(Permission $model)
    {
        $this->model = $model;
    }

    public function getPermissionsById(array $id)
    {
        return $this->model->whereIn('id', $id)->get();
    }
}