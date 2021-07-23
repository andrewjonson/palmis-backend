<?php

namespace App\Http\Controllers\RolePermissions;

use App\Traits\ResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Resources\ModelResource;
use Illuminate\Auth\Access\AuthorizationException;
use App\Http\Requests\RolePermissions\ModelRequest;
use App\Repositories\Interfaces\ModelRepositoryInterface;
use App\Repositories\Interfaces\PermissionRepositoryInterface;
use App\Repositories\Interfaces\ModuleModelRepositoryInterface;
use App\Repositories\Interfaces\ModelPermissionRepositoryInterface;

class ModelController extends Controller
{
    use ResponseTrait;

    public function __construct(
        ModelRepositoryInterface $modelRepository,
        ModelPermissionRepositoryInterface $modelPermissionRepository,
        PermissionRepositoryInterface $permissionRepository,
        ModuleModelRepositoryInterface $moduleModelRepository
    )
    {
        $this->modelRepository = $modelRepository;
        $this->modelPermissionRepository = $modelPermissionRepository;
        $this->permissionRepository = $permissionRepository;
        $this->moduleModelRepository = $moduleModelRepository;
    }

    public function create(ModelRequest $request)
    {
        $modelName = $request->name;
        $permissionId = $request->permissions;
        try {
            $permissions = $this->permissionRepository->getByIds($permissionId);
            if (count($permissions) == 0) {
                throw new AuthorizationException;
            }

            $model = $this->modelRepository->create($request->all());
            for ($i = 0; $i < count($permissionId); $i++) {
                $this->modelPermissionRepository->create([
                    'model_id' => $model->id,
                    'permission_id' => 1
                ]);
            }

            return $this->successResponse(trans('roles.model_created'), DATA_CREATED);
        } catch (\Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }

    public function showModels()
    {
        try {
            $models = $this->modelRepository->getModelsWithoutModule();
            return ModelResource::collection($models);
        } catch (\Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }
}
