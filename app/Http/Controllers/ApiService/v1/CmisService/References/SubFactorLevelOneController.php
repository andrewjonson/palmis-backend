<?php

namespace App\Http\Controllers\ApiService\v1\CmisService\References;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ConsumeExternalService;
use App\Services\ApiService\v1\CmisService\References\SubFactorLevelOne;

class SubFactorLevelOneController extends Controller
{
    use ConsumeExternalService;

    public function __construct(SubFactorLevelOne $apiService)
    {
        $this->middleware('permission:subfactorlevelone-read|admin', [
            'only' => [
                'index',
                'onlyTrashed',
                'searchSubLevelByParent',
                'searchSubLevelPoints'
            ]
        ]);
        $this->middleware('permission:subfactorlevelone-create|admin', [
            'only' => [
                'store'
            ]
        ]);
        $this->middleware('permission:subfactorlevelone-update|admin', [
            'only' => [
                'update',
                'restore'
            ]
        ]);
        $this->middleware('permission:subfactorlevelone-delete|admin', [
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

    public function searchSubLevelByParent(Request $request)
    {
        return $this->apiService->searchSubLevelByParent($request->all());
    }

    public function searchSubLevelPoints(Request $request)
    {
        return $this->apiService->searchSubLevelPoints($request->all());
    }

}