<?php

namespace App\Http\Controllers\Teams;

use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Resources\UnitResource;
use App\Http\Requests\Teams\TeamRequest;
use App\Repositories\Interfaces\TeamRepositoryInterface;
use App\Repositories\Interfaces\UnitRepositoryInterface;

class TeamController extends Controller
{
    use ResponseTrait;

    public function __construct(
        TeamRepositoryInterface $teamRepository,
        UnitRepositoryInterface $unitRepository
    )
    {
        $this->teamRepository = $teamRepository;
        $this->unitRepository = $unitRepository;
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
}
