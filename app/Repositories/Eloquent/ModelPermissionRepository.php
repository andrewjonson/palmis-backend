<?php
namespace App\Repositories\Eloquent;

use App\Models\ModelPermission;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\ModelPermissionRepositoryInterface;

class ModelPermissionRepository extends BaseRepository implements ModelPermissionRepositoryInterface
{
    public function __construct(ModelPermission $model)
    {
        $this->model = $model;
    }
}