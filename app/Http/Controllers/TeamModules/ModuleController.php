<?php

namespace App\Http\Controllers\TeamModules;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Resources\ModuleResource;
use App\Http\Requests\TeamModules\ModuleRequest;
use Illuminate\Auth\Access\AuthorizationException;
use App\Repositories\Interfaces\ModelRepositoryInterface;
use App\Repositories\Interfaces\ModuleRepositoryInterface;
use App\Repositories\Interfaces\PermissionRepositoryInterface;
use App\Repositories\Interfaces\ModuleModelRepositoryInterface;
use App\Repositories\Interfaces\ModelPermissionRepositoryInterface;

class ModuleController extends Controller
{
    use ResponseTrait;

    public function __construct(
        ModuleRepositoryInterface $moduleRepository,
        ModelRepositoryInterface $modelRepository,
        PermissionRepositoryInterface $permissionRepository,
        ModuleModelRepositoryInterface $moduleModelRepository,
        ModelPermissionRepositoryInterface $modelPermissionRepository
    )
    {
        $this->moduleRepository = $moduleRepository;
        $this->modelRepository = $modelRepository;
        $this->permissionRepository = $permissionRepository;
        $this->moduleModelRepository = $moduleModelRepository;
        $this->modelPermissionRepository = $modelPermissionRepository;
    }

    public function create(ModuleRequest $request)
    {
        try {
            $createdModule = $this->moduleRepository->create([
                'name' => $request->name,
                'description' => $request->description
            ]);

            foreach($request->model_permissions as $key => $model_permission) {
                $createdModel = $this->modelRepository->firstOrCreate([
                    'name' => $model_permission['name']
                ]);

                $this->moduleModelRepository->create([
                    'module_id' => $createdModule->id,
                    'model_id' => $createdModel->id
                ]);

                foreach($model_permission['permissions'] as $permission) {
                    $createdPermission = $this->permissionRepository->firstOrCreate([
                        'name' => Str::lower($createdModel->name).'-'.$permission['name']
                    ]);

                    $this->modelPermissionRepository->create([
                        'model_id' => $createdModel->id,
                        'permission_id' => $createdPermission->id,
                        'is_enabled' => $permission['is_enabled'] ? true : false
                    ]);
                }
            }

            return $this->successResponse(trans('teams.module_created'), DATA_CREATED);
        } catch(Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }

    public function showModules(Request $request)
    {
        $keyword = $request->keyword;
        $rowsPerPage = $request->rowsPerPage;
        try {
            $modules = $this->moduleRepository->search($keyword, $rowsPerPage);
            return ModuleResource::collection($modules);
        } catch(Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }

    public function showModule(Request $request, $moduleId)
    {
        $moduleId = hashid_decode($moduleId);
        $module = $this->moduleRepository->find($moduleId);
        if (!$module) {
            throw new AuthorizationException;
        }

        try {
            return new ModuleResource($module);
        } catch(Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }

    public function update(ModuleRequest $request, $moduleId)
    {
        $moduleId = hashid_decode($moduleId);
        $module = $this->moduleRepository->find($moduleId);
        if (!$module) {
            throw new AuthorizationException;
        }

        try {
            $module->update($request->all());
            foreach($request->model_permissions as $model_permission) {
                $updatedModel = $this->modelRepository->updateOrCreate(
                    ['id' => isset($model_permission['id']) ? hashid_decode($model_permission['id']) : null],
                    ['name' => $model_permission['name']]
                );

                $this->moduleModelRepository->updateOrCreate(
                    [
                        'module_id' => $moduleId,
                        'model_id' => $updatedModel->id
                    ],
                    [
                        'module_id' => $moduleId,
                        'model_id' => $updatedModel->id
                    ]
                );

                foreach($model_permission['permissions'] as $permission) {
                    $updatedPermission = $this->permissionRepository->updateOrCreate(
                        [
                            'id' => isset($permission['id']) ? hashid_decode($permission['id']) : null,
                            'name' => Str::lower($updatedModel->name).'-'.$permission['name']
                        ],
                        ['name' => Str::lower($updatedModel->name).'-'.$permission['name']]
                    );
                    
                    $this->modelPermissionRepository->updateOrCreate(
                        [
                            'model_id' => $updatedModel->id,
                            'permission_id' => $updatedPermission->id
                        ],
                        [
                            'model_id' => $updatedModel->id,
                            'permission_id' => $updatedPermission->id,
                            'is_enabled' => $permission['is_enabled'] ? true : false
                        ]
                    );
                }
            }
            
            return $this->successResponse(trans('teams.module_updated'), DATA_OK);
        } catch(Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }

    public function getModulesWithModel()
    {
        try {
            $modules = $this->moduleRepository->getModulesWithModel();
            return ModuleResource::collection($modules);
        } catch(Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }

    public function delete($moduleId)
    {
        $moduleId = hashid_decode($moduleId);
        $module = $this->moduleRepository->find($moduleId);
        if (!$module) {
            throw new AuthorizationException;
        }

        try {
            $module->delete();
            return $this->successResponse(trans('teams.module_deleted'), DATA_OK);
        } catch(Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }

    public function restore($moduleId)
    {
        $moduleId = hashid_decode($moduleId);
        $module = $this->moduleRepository->onlyTrashedById($moduleId);
        if (!$module) {
            throw new AuthorizationException;
        }

        try {
            $module->restore();
            return $this->successResponse(trans('teams.module_restored'), DATA_OK);
        } catch(Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }

    public function onlyTrashed(Request $request)
    {
        $keyword = $request->keyword;
        $rowsPerPage = $request->rowsPerPage;
        try {
            $modules = $this->moduleRepository->onlyTrashed($keyword, $rowsPerPage);
            return ModuleResource::collection($modules);
        } catch(Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }

    public function forceDelete($moduleId)
    {
        $moduleId = hashid_decode($moduleId);
        $module = $this->moduleRepository->onlyTrashedById($moduleId);
        if (!$module) {
            throw new AuthorizationException;
        }

        try {
            $module->forceDelete();
            return $this->successResponse(trans('teams.module_permanently_deleted'), DATA_OK);
        } catch(Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }
}
