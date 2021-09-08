<?php

namespace App\Http\Controllers\ApiService\v1\CmisService\References;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ConsumeExternalService;
use App\Services\ApiService\v1\CmisService\References\SubFactor;

class SubFactorController extends Controller
{
    use ConsumeExternalService;

    public function __construct(SubFactor $apiService)
    {
        $this->middleware('permission:subfactor-read|admin', [
            'only' => [
                'index',
                'onlyTrashed',
                'searchSubfactorByCriteriaAndQrs'
            ]
        ]);
        $this->middleware('permission:subfactor-create|admin', [
            'only' => [
                'store'
            ]
        ]);
        $this->middleware('permission:subfactor-update|admin', [
            'only' => [
                'update',
                'restore'
            ]
        ]);
        $this->middleware('permission:subfactor-delete|admin', [
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

    public function searchSubfactorByCriteriaAndQrs(Request $request)
    {
        return $this->apiService->searchSubfactorByCriteriaAndQrs($request->all());
    }

    public function getDataByCriteria(Request $request)
    {
        return $this->apiService->getDataByCriteria($request->all());
    }
}