<?php

namespace App\Http\Controllers\ApiService\v1\SumisService\References;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ConsumeExternalService;
use App\Services\ApiService\v1\SumisService\References\AmmunitionHeadStumpMarking;

class AmmunitionHeadStumpMarkingController extends Controller
{
    use ConsumeExternalService;

    public function __construct(AmmunitionHeadStumpMarking $apiService)
    {
        $this->middleware('permission:ammunitionheadstumpmarking-read|admin', [
            'only' => [
                'index',
                'onlyTrashed'
            ]
        ]);
        $this->middleware('permission:ammunitionheadstumpmarking-create|admin', [
            'only' => [
                'store'
            ]
        ]);
        $this->middleware('permission:ammunitionheadstumpmarking-update|admin', [
            'only' => [
                'update',
                'restore'
            ]
        ]);
        $this->middleware('permission:ammunitionheadstumpmarking-delete|admin', [
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
}