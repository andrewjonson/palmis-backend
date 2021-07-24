<?php

namespace App\Http\Controllers\TeamModules;

use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Resources\TeamResource;
use App\Http\Resources\UnitResource;
use App\Http\Resources\UserResource;
use App\Http\Requests\TeamModules\TeamRequest;
use Illuminate\Auth\Access\AuthorizationException;
use App\Http\Requests\TeamModules\TeamAssignAllRequest;
use App\Repositories\Interfaces\RoleRepositoryInterface;
use App\Repositories\Interfaces\TeamRepositoryInterface;
use App\Repositories\Interfaces\UnitRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\Interfaces\ModuleRepositoryInterface;
use App\Repositories\Interfaces\UserRoleRepositoryInterface;

class TeamController extends Controller
{
    use ResponseTrait;

    public function __construct(
        TeamRepositoryInterface $teamRepository,
        UnitRepositoryInterface $unitRepository,
        UserRepositoryInterface $userRepository,
        UserRoleRepositoryInterface $userRoleRepository,
        ModuleRepositoryInterface $moduleRepository,
        RoleRepositoryInterface $roleRepository
    )
    {
        $this->teamRepository = $teamRepository;
        $this->unitRepository = $unitRepository;
        $this->userRepository = $userRepository;
        $this->userRoleRepository = $userRoleRepository;
        $this->moduleRepository = $moduleRepository;
        $this->roleRepository = $roleRepository;
    }

    public function showUnits(Request $request)
    {
        $keyword = $request->keyword;
        $rowsPerPage = $request->rowsPerPage;
        try {
            $units = $this->unitRepository->searchUnit($keyword, $rowsPerPage);
            return UnitResource::collection($units);
        } catch(Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }

    public function create(TeamRequest $request)
    {
        try {
            $unit = $this->unitRepository->getUnitByUnitCode($request->name);
            if (!$unit) {
                return $this->failedResponse(trans('teams.invalid_unit'), BAD_REQUEST);
            }

            $this->teamRepository->create($request->all());
            return $this->successResponse(trans('teams.team_created'), DATA_CREATED);
        } catch(Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }

    public function showTeams(Request $request)
    {
        $keyword = $request->keyword;
        $rowsPerPage = $request->rowsPerPage;
        try {
            $teams = $this->teamRepository->search($keyword, $rowsPerPage);
            return TeamResource::collection($teams);
        } catch(Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }

    public function delete($teamId)
    {
        $teamId = hashid_decode($teamId);
        $team = $this->teamRepository->find($teamId);
        if (!$teamId || !$team) {
            throw new AuthorizationException;
        }

        try {
            $team->delete();
            return $this->successResponse(trans('teams.team_deleted'), DATA_OK);
        } catch(Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }

    public function onlyTrashed(Request $request)
    {
        $keyword = $request->keyword;
        $rowsPerPage = $request->rowsPerPage;
        try {
            $results = $this->teamRepository->onlyTrashed($keyword, $rowsPerPage);
            return TeamResource::collection($results);
        } catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }

    public function restore($teamId)
    {
        $teamId = hashid_decode($teamId);
        $data = $this->teamRepository->onlyTrashedById($teamId);
        if (!$data) {
            throw new AuthorizationException;
        }

        try {
            $data->restore();
            return $this->successResponse(trans('teams.restored'), DATA_OK);
        } catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }

    public function forceDelete($teamId)
    {
        $teamId = hashid_decode($teamId);
        $data = $this->teamRepository->onlyTrashedById($teamId);
        if (!$data) {
            throw new AuthorizationException;
        }

        try {
            $data->forceDelete();
            return $this->successResponse(trans('teams.force_deleted'), DATA_OK);
        } catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }

    public function assignUsers(Request $request, $teamId)
    {
        $teamId = hashid_decode($teamId);
        if (!$teamId) {
            throw new AuthorizationException;
        }
        foreach($request->user_id as $userId) {
            $userId = hashid_decode($userId);
            $user[] = $this->userRepository->find($userId);
        }
        
        if (empty($user)) {
            $userId = [];
        } else {
            $userId = Arr::pluck($user, 'id');
        }
        $this->userRepository->unAssignTeams($userId, $teamId);
        $this->userRepository->assignTeams($userId, $teamId);
        return $this->successResponse(trans('teams.user_assigned'), DATA_OK);

        try {
            
        } catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }

    public function usersWithTeam($teamId)
    {
        try {
            $teamId = hashid_decode($teamId);
            $users = $this->userRepository->getUsersWithTeam($teamId);
            return UserResource::collection($users);
        } catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }

    public function usersWithoutTeam() 
    {
        try {
            $users = $this->userRepository->getUsersWithoutTeam();
            return UserResource::collection($users);
        } catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }

    public function assignAll(TeamAssignAllRequest $request, $userId)
    {
        try {
            $userId = hashid_decode($userId);
            $user = $this->userRepository->find($userId);
            if (!$user) {
                throw new AuthorizationException;
            }

            if ($user->is_superadmin) {
                $user->update([
                    'is_superadmin' => false
                ]);
            }
            
            $teamId = hashid_decode($request->team_id);
            $roleId = $request->role_id;

            foreach($request->module_id as $key => $moduleId) {
                $modules[] = $this->moduleRepository->find(hashid_decode($moduleId));
                $roles[] = $this->roleRepository->find(hashid_decode($roleId[$key]));
            }

            $roleId = Arr::pluck($roles, 'id');
            $moduleId = Arr::pluck($modules, 'id');
            $this->userRepository->unAssignTeam($userId, $teamId);
            $this->userRepository->unAssignModules($moduleId, $teamId);
            $this->userRoleRepository->unAssignRoles($roleId, $userId);
            $this->userRepository->assignTeam($userId, $teamId);
            $this->userRepository->find($userId)->assignRole($roleId);
            $moduleId = serialize($moduleId);
            $this->userRepository->assignModules($moduleId, $userId);

            return $this->successResponse(trans('teams.assigned_all'), DATA_OK);
        } catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }

    public function unAssignUser($userId)
    {
        $userId = hashid_decode($userId);
        $user = $this->userRepository->find($userId);
        if (!$user) {
            throw new AuthorizationException;
        }

        try {
            $this->userRepository->unAssignUser($userId);
            return $this->successResponse(trans('teams.unassigned_user'), DATA_OK);
        } catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }
}
