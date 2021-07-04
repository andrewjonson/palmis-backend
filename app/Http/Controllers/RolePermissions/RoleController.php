<?php

namespace App\Http\Controllers\RolePermissions;

use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Resources\RoleResource;
use App\Http\Requests\RolePermissions\RoleRequest;
use Illuminate\Auth\Access\AuthorizationException;
use App\Repositories\Interfaces\RoleRepositoryInterface;
use App\Repositories\Interfaces\PermissionRepositoryInterface;

class RoleController extends Controller
{
    use ResponseTrait;

    public function __construct(
        RoleRepositoryInterface $roleRepository,
        PermissionRepositoryInterface $permissionRepository
    )
    {
        $this->middleware('permission:request-create', [
            'only' => [
                'showRoles',
                'create'
            ]
        ]);

        $this->roleRepository = $roleRepository;
        $this->permissionRepository = $permissionRepository;
    }

    public function showRoles(Request $request)
    {
        $keyword = $request->keyword;
        $rowsPerPage = $request->rowsPerPage;

        try {
            $roles = $this->roleRepository->search($keyword, $rowsPerPage);
            return RoleResource::collection($roles);
        } catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), 500);
        }
    }

    public function create(RoleRequest $request)
    {
        try {
            $this->roleRepository->create($request->all());
            return $this->successResponse(trans('roles.role_created'), 201);
        } catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), 500);
        }
    }

    public function update(RoleRequest $request, $roleId)
    {
        $role = $this->roleRepository->find($roleId);
        if (!$role) {
            throw new AuthorizationException;
        }

        try {
            $role->update($request->all());
            return $this->successResponse(trans('roles.role_updated'), 200);
        } catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), 500);
        }
    }

    public function delete($roleId)
    {
        $role = $this->roleRepository->find($roleId);
        if (!$role) {
            throw new AuthorizationException;
        }

        try {
            $role->delete();
            return $this->successResponse(trans('roles.role_deleted'), 200);
        } catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), 500);
        }
    }

    public function assignPermissions(Request $request)
    {
        $roleId = $request->role_id;
        $permissions = $request->permissions;

        try {
            $role = $this->roleRepository->find($roleId);
            $permissions = $this->permissionRepository->getPermissionsById($permissions);
            $role->syncPermissions($permissions);
            $user = auth()->user();
            $user->assignRole([$roleId]);
            return $this->successResponse(trans('roles.permissions_assigned'), 200);
        } catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), 500);
        }
    }
}
