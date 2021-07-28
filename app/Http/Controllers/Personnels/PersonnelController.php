<?php

namespace App\Http\Controllers\Personnels;

use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Resources\PersonnelResource;
use App\Repositories\Interfaces\PersonnelRepositoryInterface;

class PersonnelController extends Controller
{
    use ResponseTrait;
    
    public function __construct(PersonnelRepositoryInterface $personnelRepository)
    {
        $this->personnelRepository = $personnelRepository;
    }

    public function searchPersonnelByAfpsn(Request $request)
    {
        $afpsn = $request->afpsn;
        $rowsPerPage = $request->rowsPerPage;
        try {
            if (!$afpsn) {
                return $this->failedResponse(trans('personnels.search'), VALIDATION_EXCEPTION);
            }

            $personnels = $this->personnelRepository->searchPersonnelByAfpsn($afpsn, $rowsPerPage);
            return PersonnelResource::collection($personnels);
        } catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }
}
