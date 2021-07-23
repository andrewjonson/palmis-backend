<?php

namespace App\Http\Controllers\TeamModules;

use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Resources\TeamResource;
use App\Http\Resources\UnitResource;
use App\Http\Resources\UserResource;
use App\Http\Requests\TeamModules\TeamRequest;
use Illuminate\Auth\Access\AuthorizationException;
use App\Http\Requests\TeamModules\TeamAssignAllRequest;
use App\Repositories\Interfaces\TeamRepositoryInterface;
use App\Repositories\Interfaces\UnitRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\Interfaces\TeamUserRepositoryInterface;
use App\Repositories\Interfaces\UserRoleRepositoryInterface;
use App\Repositories\Interfaces\TeamModuleRepositoryInterface;

class TeamController extends Controller
{
    use ResponseTrait;

    public function __construct(
        TeamRepositoryInterface $teamRepository,
        UnitRepositoryInterface $unitRepository,
        UserRepositoryInterface $userRepository,
        TeamUserRepositoryInterface $teamUserRepository,
        TeamModuleRepositoryInterface $teamModuleRepository,
        UserRoleRepositoryInterface $userRoleRepository
    )
    {
        $this->teamRepository = $teamRepository;
        $this->unitRepository = $unitRepository;
        $this->userRepository = $userRepository;
        $this->teamUserRepository = $teamUserRepository;
        $this->teamModuleRepository = $teamModuleRepository;
        $this->userRoleRepository = $userRoleRepository;
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

        $userId = $this->userRepository->getUsersById($request->user_id);
        $this->teamUserRepository->unAssignUsers($userId, $teamId);
        for ($i = 0; $i < count($userId); $i++) {
            $this->teamUserRepository->assignUsers($userId[$i], $teamId);
        }

        return $this->successResponse(trans('teams.user_assigned'), DATA_OK);
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
            
            $teamId = $request->team_id;
            $moduleId = $request->module_id;
            $roleId = $request->role_id;
            $this->teamUserRepository->unAssignUser($userId, $teamId);
            $this->teamModuleRepository->unAssignModules($moduleId, $teamId);
            $this->userRoleRepository->unAssignRoles($roleId, $userId);
            $this->teamUserRepository->assignUsers($userId, $teamId);
            $this->userRepository->find($userId)->assignRole($roleId);
            for ($i = 0; $i < count($moduleId); $i++) {
                $this->teamModuleRepository->assignModules($moduleId[$i], $teamId);
            }

            return $this->successResponse(trans('teams.assigned_all'), DATA_OK);
        } catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }
}
