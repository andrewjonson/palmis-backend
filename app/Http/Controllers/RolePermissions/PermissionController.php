<?php

namespace App\Http\Controllers\RolePermissions;

use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Resources\PermissionResource;
use Illuminate\Auth\Access\AuthorizationException;
use App\Http\Requests\RolePermissions\PermissionRequest;
use App\Repositories\Interfaces\PermissionRepositoryInterface;

class PermissionController extends Controller
{
    use ResponseTrait;

    public function __construct(PermissionRepositoryInterface $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
    }

    public function showPermissions(Request $request)
    {
        $keyword = $request->keyword;
        $rowsPerPage = $request->rowsPerPage;

        try {
            $permissions = $this->permissionRepository->search($keyword, $rowsPerPage);
            return PermissionResource::collection($permissions);
        } catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), 500);
        }
    }

    public function create(PermissionRequest $request)
    {
        try {
            $this->permissionRepository->create($request->all());
            return $this->successResponse(trans('roles.permission_created'), 201);
        } catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), 500);
        }
    }

    public function update(PermissionRequest $request, $permissionId)
    {
        $permission = $this->permissionRepository->find($permissionId);
        if (!$permission) {
            throw new AuthorizationException;
        }

        try {
            $permission->update($request->all());
            return $this->successResponse(trans('roles.permission_updated'), 200);
        } catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), 500);
        }
    }

    public function delete($permissionId)
    {
        $permission = $this->permissionRepository->find($permissionId);
        if (!$permission) {
            throw new AuthorizationException;
        }

        try {
            $permission->delete();
            return $this->successResponse(trans('roles.permission_deleted'), 200);
        } catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), 500);
        }
    }
}
