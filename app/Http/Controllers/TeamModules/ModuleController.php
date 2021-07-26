<?php

namespace App\Http\Controllers\TeamModules;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Resources\ModuleResource;
use App\Http\Requests\TeamModules\ModuleRequest;
use Illuminate\Auth\Access\AuthorizationException;
use App\Http\Resources\ModuleModelPermissionResource;
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
                    'name' => $model_permission['model']
                ]);

                $this->moduleModelRepository->create([
                    'module_id' => $createdModule->id,
                    'model_id' => $createdModel->id
                ]);

                foreach($model_permission['permissions'] as $permission) {
                    $model = preg_replace("/[\s_-]+/", "", $createdModel->name);
                    $createdPermission = $this->permissionRepository->firstOrCreate([
                        'name' => Str::lower($model).'-'.$permission
                    ]);

                    $this->modelPermissionRepository->create([
                        'model_id' => $createdModel->id,
                        'permission_id' => $createdPermission->id
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
        if (!$moduleId) {
            throw new AuthorizationException;
        }

        try {
            $module = $this->moduleRepository->find($moduleId);
            if (!$module) {
                return $this->failedResponse(trans('teams.module_not_exist'), BAD_REQUEST);
            }

            $module->update($request->all());
            return $this->successResponse(trans('teams.module_updated'), DATA_OK);
        } catch(Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }

    public function showModuleModelPermissions()
    {
        try {
            $modules = $this->moduleRepository->getModulesWithModel();
            return ModuleModelPermissionResource::collection($modules);
        } catch(Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }
}
