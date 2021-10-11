<?php

namespace App\Http\Controllers\Personnels;

use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Resources\PersonnelResource;
use Illuminate\Auth\Access\AuthorizationException;
use App\Services\ApiService\v1\MpisService\Transactions\Personnel;

class PersonnelController extends Controller
{
    use ResponseTrait;
    
    public function __construct(Personnel $personnelService)
    {
        $this->personnelService = $personnelService;
    }

    public function searchPersonnelBySerialNumber(Request $request)
    {
        $serialNumber = $request->serial_number;
        try {
            if (!$serialNumber) {
                return $this->failedResponse(trans('personnels.search'), VALIDATION_EXCEPTION);
            }
            
            return $personnels = $this->personnelService->searchPersonnelBySerial($request->all());
            return PersonnelResource::collection($personnels);
        } catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }

    public function getPersonnelByPmcode(Request $request, $pmcode)
    {
        try {
            if (!$pmcode) {
                return $this->failedResponse(trans('personnels.pmcode'), VALIDATION_EXCEPTION);
            }

            $personnel = $this->personnelRepository->getPersonnelByPmcode($pmcode);
            if ($personnel) {
                return new PersonnelResource($personnel);
            }
            
            throw new AuthorizationException;
        } catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }
}
