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
use App\Repositories\Interfaces\RolePermissionRepositoryInterface;

class RoleController extends Controller
{
    use ResponseTrait;

    public function __construct(
        RoleRepositoryInterface $roleRepository,
        PermissionRepositoryInterface $permissionRepository,
        RolePermissionRepositoryInterface $rolePermissionRepository
    )
    {
        $this->roleRepository = $roleRepository;
        $this->permissionRepository = $permissionRepository;
        $this->rolePermissionRepository = $rolePermissionRepository;
    }

    public function showRoles(Request $request)
    {
        $keyword = $request->keyword;
        $rowsPerPage = $request->rowsPerPage;

        try {
            $roles = $this->roleRepository->search($keyword, $rowsPerPage);
            return RoleResource::collection($roles);
        } catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }

    public function create(RoleRequest $request)
    {
        try {
            $role = $this->roleRepository->create([
                'name' => $request->name
            ]);

            foreach ($request->permission_id as $permission_id) {
                $permission_id = hashid_decode($permission_id);
                $this->rolePermissionRepository->firstOrCreate([
                    'permission_id' => $permission_id,
                    'role_id' => $role->id
                ]);
            }
            return $this->successResponse(trans('roles.role_created'), DATA_CREATED);
        } catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }

    public function update(RoleRequest $request, $roleId)
    {
        $roleId = hashid_decode($roleId);
        $role = $this->roleRepository->find($roleId);
        if (!$role) {
            throw new AuthorizationException;
        }

        try {
            $role->update($request->all());
            return $this->successResponse(trans('roles.role_updated'), DATA_OK);
        } catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }

    public function delete($roleId)
    {
        $roleId = hashid_decode($roleId);
        $role = $this->roleRepository->find($roleId);
        if (!$role) {
            throw new AuthorizationException;
        }

        try {
            $role->delete();
            return $this->successResponse(trans('roles.role_deleted'), DATA_OK);
        } catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }

    public function assignPermissions(Request $request, $roleId)
    {
        $roleId = hashid_decode($role_id);
        $permissions = $request->permissions;
        try {
            $role = $this->roleRepository->find($roleId);
            foreach($permissions as $permission) {
                $permissions[] = $this->permissionRepository->find(hashid_decode($permission));
            }

            return var_dump($permissions);
            
            $role->syncPermissions($permissions);
            $user = auth()->user();
            $user->assignRole([$roleId]);
            return $this->successResponse(trans('roles.permissions_assigned'), DATA_OK);
        } catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }
}
