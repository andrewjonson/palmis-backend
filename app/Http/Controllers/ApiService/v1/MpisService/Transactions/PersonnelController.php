<?php

namespace App\Http\Controllers\ApiService\v1\MpisService\Transactions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ConsumeExternalService;
use App\Traits\RestfulApiServiceControllerTrait;
use App\Services\ApiService\v1\MpisService\Transactions\Personnel;

class PersonnelController extends Controller
{
    use ConsumeExternalService, RestfulApiServiceControllerTrait;

    public function __construct(Personnel $apiService)
    {
        $this->middleware('permission:personnel-read|admin', [
            'only' => [
                'index',
                'onlyTrashed',
                'searchPersonnel',
                'getPersonnelById',
                'advanceSearchPersonnel',
                'getPersonnelByPmcode',
                'uploadPersonnelImage',
                'searchPersonnelBySerialNumberBirthdate',
                'searchPersonnelBySerial',
                'countPersonnel'
            ]
        ]);
        $this->middleware('permission:personnel-create|admin', [
            'only' => [
                'createPersonnel',
                'createPersonnelRank',
                'createPersonnelUnit',
                'createPersonnelAddress',

            ]
        ]);
        $this->middleware('permission:personnel-update|admin', [
            'only' => [
                'updatePersonnelAddress'
            ]
        ]);
        $this->middleware('permission:personnel-delete|admin', [
            'only' => [
                'delete',
                'forceDelete'
            ]
        ]);
        $this->apiService = $apiService;
    }

    public function searchPersonnel(Request $request)
    {
        return $this->apiService->searchPersonnel($request->all());
    }

    public function getPersonnelById($id)
    {
        return $this->apiService->getPersonnelById($id);
    }

    public function advanceSearchPersonnel(Request $request)
    {
        return $this->apiService->advanceSearchPersonnel($request->all());
    }

    public function getPersonnelByPmcode($id)
    {
        return $this->apiService->getPersonnelByPmcode($id);
    }

    public function uploadPersonnelImage(Request $request)
    {
        $image = $request->image->getClientOriginalName();
        $personnelImage = array_merge($request->all(),['image' => $image]);
        return $this->apiService->uploadPersonnelImage($personnelImage);
    }

    public function searchPersonnelBySerialNumberBirthdate(Request $request)
    {
        return $this->apiService->searchPersonnelBySerialNumberBirthdate($request->all());
    }

    public function searchPersonnelBySerial(Request $request)
    {
        return $this->apiService->searchPersonnelBySerial($request->all());
    }

    public function createPersonnel(Request $request)
    {
        return $this->apiService->createPersonnel($request->all());
    }

    public function createPersonnelRank(Request $request)
    {
        return $this->apiService->createPersonnelRank($request->all());
    }

    public function createPersonnelUnit(Request $request)
    {
        return $this->apiService->createPersonnelRank($request->all());
    }

    public function createPersonnelAddress(Request $request)
    {
        return $this->apiService->createPersonnelAddress($request->all());
    }

    public function updatePersonnelAddress(Request $request, $id)
    {
        return $this->apiService->updatePersonnelAddress($request->all(), $id);
    }

    public function countPersonnel()
    {
        return $this->apiService->countPersonnel();
    }

}