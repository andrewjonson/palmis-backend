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
                'searchPersonnelBySerial',
                'countPersonnel',
                'getPersonnelAddress',
                'dynamicSearchPersonnel',
                'searchPersonnelBySerialNumber',
                'searchPersonnelId',
                'getPersonnelAfposmosByPmcode',
                'getPersonnelDetailByPmcode'
            ]
        ]);
        $this->middleware('permission:personnel-create|admin', [
            'only' => [
                'createPersonnel',
                'createPersonnelRank',
                'createPersonnelUnit',
                'createPersonnelAddress',
                'createPersonnelPromotion'

            ]
        ]);
        $this->middleware('permission:personnel-update|admin', [
            'only' => [
                'updatePersonnelAddress',
                'updatePersonnel'
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
        if ($request->uploadType === 'base64') {
            $image = $request->image;
        } else {
            $image = $request->image->getClientOriginalName();
        }
        $personnelImage = array_merge($request->all(),['image' => $image]);
        return $this->apiService->uploadPersonnelImage($personnelImage);
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

    public function getPersonnelAddress($id)
    {
        return $this->apiService->getPersonnelAddress($id);
    }

    public function updatePersonnelAddress(Request $request, $id)
    {
        return $this->apiService->updatePersonnelAddress($request->all(), $id);
    }

    public function countPersonnel()
    {
        return $this->apiService->countPersonnel();
    }

    public function updatePersonnel(Request $request, $id)
    {
        return $this->apiService->updatePersonnel($request->all(), $id);
    }

    public function createPersonnelPromotion(Request $request)
    {
        return $this->apiService->createPersonnelPromotion($request->all());
    }

    public function dynamicSearchPersonnel(Request $request)
    {
        return $this->apiService->dynamicSearchPersonnel($request->all());
    }

    public function searchPersonnelBySerialNumber(Request $request)
    {
        return $this->apiService->searchPersonnelBySerialNumber($request->all());
    }

    public function searchPersonnelId(Request $request)
    {
        return $this->apiService->searchPersonnelId($request->all());
    }

    public function getPersonnelAfposmosByPmcode($pmcode)
    {
        return $this->apiService->getPersonnelAfposmosByPmcode($pmcode);
    }

    public function getPersonnelDetailByPmcode($pmcode)
    {
        return $this->apiService->getPersonnelDetailByPmcode($pmcode);
    }
}