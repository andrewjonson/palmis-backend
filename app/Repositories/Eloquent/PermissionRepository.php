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

    public function updatePermissionByModelId($modelId, array $data)
    {
        return $this->model->whereHas('modelPermissions', function($query) use($modelId) {
            $query->where('model_id', $modelId);
        })->update($data);
    }
}