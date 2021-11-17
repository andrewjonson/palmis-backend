<?php

namespace App\Http\Controllers\ApiService\v1\CmisService\References;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ConsumeExternalService;
use App\Services\ApiService\v1\CmisService\References\Award;

class AwardController extends Controller
{
    use ConsumeExternalService;

    public function __construct(Award $apiService)
    {
        $this->middleware('permission:award-read|admin', [
            'only' => [
                'index',
                'onlyTrashed',
                'searchAwardById',
                'getAwardTypeC',
                'getAwardTypeA'
            ]
        ]);
        $this->middleware('permission:award-create|admin', [
            'only' => [
                'store'
            ]
        ]);
        $this->middleware('permission:award-update|admin', [
            'only' => [
                'update',
                'restore'
            ]
        ]);
        $this->middleware('permission:award-delete|admin', [
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

    public function searchAwardById($id)
    {
        return $this->apiService->searchAwardById($id);
    }

    public function getAwardTypeA(Request $request)
    {
        return $this->apiService->getAwardTypeA($request->all());
    }

    public function getAwardTypeC(Request $request)
    {
        return $this->apiService->getAwardTypeC($request->all());
    }
}