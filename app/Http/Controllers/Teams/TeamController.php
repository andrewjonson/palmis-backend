<?php

namespace App\Http\Controllers\Teams;

use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Resources\UnitResource;
use App\Http\Requests\Teams\TeamRequest;
use Illuminate\Auth\Access\AuthorizationException;
use App\Repositories\Interfaces\TeamRepositoryInterface;
use App\Repositories\Interfaces\UnitRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\Interfaces\TeamUserRepositoryInterface;

class TeamController extends Controller
{
    use ResponseTrait;

    public function __construct(
        TeamRepositoryInterface $teamRepository,
        UnitRepositoryInterface $unitRepository,
        UserRepositoryInterface $userRepository,
        TeamUserRepositoryInterface $teamUserRepository
    )
    {
        $this->teamRepository = $teamRepository;
        $this->unitRepository = $unitRepository;
        $this->userRepository = $userRepository;
        $this->teamUserRepository = $teamUserRepository;
    }

    public function showUnits(Request $request)
    {
        $keyword = $request->keyword;
        $rowsPerPage = $request->rowsPerPage;
        try {
            $units = $this->unitRepository->search($keyword, $rowsPerPage);
            return UnitResource::collection($units);
        } catch(Exception $e) {
            return $this->failedResponse($e->getMessage(), 500);
        }
    }

    public function create(TeamRequest $request)
    {
        try {
            $unit = $this->unitRepository->getUnitByUnitCode($request->name);
            if (!$unit) {
                return $this->failedResponse(trans('teams.invalid_unit'), 400);
            }

            $this->teamRepository->create($request->all());
            return $this->successResponse(trans('teams.team_created'), 201);
        } catch(Exception $e) {
            return $this->failedResponse($e->getMessage(), 500);
        }
    }

    public function delete($teamId)
    {
        $team = $this->teamRepository->find($teamId);
        if (!$teamId || !$team) {
            throw new AuthorizationException;
        }

        try {
            $team->delete();
            return $this->successResponse(trans('teams.team_deleted'), 200);
        } catch(Exception $e) {
            return $this->failedResponse($e->getMessage(), 500);
        }
    }

    public function assignUsers(Request $request, $teamId)
    {
        $userId = $request->user_id;
        if (!$teamId) {
            throw new AuthorizationException;
        }

        $userExists = $this->teamUserRepository->getUsersById($userId);
        for ($i = 0; $i < count($userId); $i++) {
            $this->teamUserRepository->assignUsers($userId[$i], $teamId);
        }

        return $this->successResponse(trans('teams.user_assigned'), 200);
    }
}
