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
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }

    public function create(PermissionRequest $request)
    {
        try {
            $this->permissionRepository->create($request->all());
            return $this->successResponse(trans('roles.permission_created'), DATA_CREATED);
        } catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }

    public function update(PermissionRequest $request, $permissionId)
    {
        $permissionId = hashid_decode($permissionId);
        $permission = $this->permissionRepository->find($permissionId);
        if (!$permission) {
            throw new AuthorizationException;
        }

        try {
            $permission->update($request->all());
            return $this->successResponse(trans('roles.permission_updated'), DATA_OK);
        } catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }

    public function delete($permissionId)
    {
        $permissionId = hashid_decode($permissionId);
        $permission = $this->permissionRepository->find($permissionId);
        if (!$permission) {
            throw new AuthorizationException;
        }

        try {
            $permission->delete();
            return $this->successResponse(trans('roles.permission_deleted'), DATA_OK);
        } catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }
}
