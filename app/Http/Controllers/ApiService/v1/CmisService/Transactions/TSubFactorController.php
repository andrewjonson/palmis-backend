<?php

namespace App\Http\Controllers\ApiService\v1\CmisService\Transactions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ConsumeExternalService;
use App\Services\ApiService\v1\CmisService\Transactions\TSubFactor;

class TSubFactorController extends Controller
{
    use ConsumeExternalService;

    public function __construct(TSubFactor $apiService)
    {
        $this->middleware('permission:tsubfactor-read|admin', [
            'only' => [
                'index',
                'onlyTrashed',
                'searchPoints',
                'searchByCriteria',
                'getDataByCriteria'
            ]
        ]);
        $this->middleware('permission:tsubfactor-create|admin', [
            'only' => [
                'store'
            ]
        ]);
        $this->middleware('permission:tsubfactor-update|admin', [
            'only' => [
                'update',
                'restore'
            ]
        ]);
        $this->middleware('permission:tsubfactor-delete|admin', [
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

    public function searchPoints(Request $request)
    {
        return $this->apiService->searchPoints($request->all());
    }

    public function searchByCriteria(Request $request)
    {
        return $this->apiService->searchByCriteria($request->all());
    }

    public function getDataByCriteria(Request $request)
    {
        return $this->apiService->getDataByCriteria($request->all());
    }

}