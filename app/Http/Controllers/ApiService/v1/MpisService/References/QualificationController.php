<?php

namespace App\Http\Controllers\ApiService\v1\MpisService\References;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ConsumeExternalService;
use App\Services\ApiService\v1\MpisService\References\Qualification;

class QualificationController extends Controller
{
    use ConsumeExternalService;

    public function __construct(Qualification $apiService)
    {
        $this->middleware('permission:qualification-read|admin', [
            'only' => [
                'index',
                'onlyTrashed'
            ]
        ]);
        $this->middleware('permission:qualification-create|admin', [
            'only' => [
                'store'
            ]
        ]);
        $this->middleware('permission:qualification-update|admin', [
            'only' => [
                'update',
                'restore'
            ]
        ]);
        $this->middleware('permission:qualification-delete|admin', [
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