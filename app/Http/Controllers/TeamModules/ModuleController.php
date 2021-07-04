<?php

namespace App\Http\Controllers\TeamModules;

use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Resources\ModuleResource;
use App\Http\Requests\Teams\ModuleRequest;
use Illuminate\Auth\Access\AuthorizationException;
use App\Repositories\Interfaces\ModuleRepositoryInterface;

class ModuleController extends Controller
{
    use ResponseTrait;

    public function __construct(ModuleRepositoryInterface $moduleRepository)
    {
        $this->moduleRepository = $moduleRepository;
    }

    public function create(ModuleRequest $request)
    {
        try {
            $this->moduleRepository->create($request->all());
            return $this->successResponse(trans('teams.module_created'), 201);
        } catch(Exception $e) {
            return $this->failedResponse($e->getMessage(), 500);
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
            return $this->failedResponse($e->getMessage(), 500);
        }
    }

    public function update(ModuleRequest $request, $moduleId)
    {
        if (!$moduleId) {
            throw new AuthorizationException;
        }

        try {
            $module = $this->moduleRepository->find($moduleId);
            if (!$module) {
                return $this->failedResponse(trans('teams.module_not_exist'), 400);
            }

            $module->update($request->all());
            return $this->successResponse(trans('teams.module_updated'), 200);
        } catch(Exception $e) {
            return $this->failedResponse($e->getMessage(), 500);
        }
    }
}
