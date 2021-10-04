<?php

namespace App\Http\Controllers\ApiService\v1\MpisService\References;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ConsumeExternalService;
use App\Services\ApiService\v1\MpisService\References\CivilStatus;

class CivilStatusController extends Controller
{
    use ConsumeExternalService;

    public function __construct(CivilStatus $apiService)
    {
        $this->middleware('permission:civilstatus-read|admin', [
            'only' => [
                'index',
                'onlyTrashed',
                'searchCivilStatus',
                'getCivilStatusById'
            ]
        ]);
        $this->middleware('permission:civilstatus-create|admin', [
            'only' => [
                'store'
            ]
        ]);
        $this->middleware('permission:civilstatus-update|admin', [
            'only' => [
                'update',
                'restore'
            ]
        ]);
        $this->middleware('permission:civilstatus-delete|admin', [
            'only' => [
                'delete',
                'forceDelete'
            ]
        ]);
        $this->apiService = $apiService;
    }

    public function index(Request $request)
    {
        return $this->apiService->index($request->all());
    }

    public function store(Request $request)
    {
        return $this->apiService->store($request->all());
    }

    public function update(Request $request, $id)
    {
        return $this->apiService->update($request->all(), $id);
    }

    public function delete($id)
    {
        return $this->apiService->delete($id);
    }

    public function onlyTrashed(Request $request)
    {
        return $this->apiService->onlyTrashed($request->all());
    }

    public function restore($id)
    {
        return $this->apiService->restore($id);
    }

    public function forceDelete($id)
    {
        return $this->apiService->forceDelete($id);
    }

    public function searchCivilStatus(Request $request)
    {
        return $this->apiService->searchCivilStatus($request->all());
    }

    public function getCivilStatusById($id)
    {
        return $this->apiService->getCivilStatusById($id);
    }
}