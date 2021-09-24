<?php

namespace App\Http\Controllers\ApiService\v1\MpisService\References;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ConsumeExternalService;
use App\Services\ApiService\v1\MpisService\References\Zipcode;

class ZipcodeController extends Controller
{
    use ConsumeExternalService;

    public function __construct(Zipcode $apiService)
    {
        $this->middleware('permission:zipcode-read|admin', [
            'only' => [
                'index',
                'onlyTrashed',
                'getZipcode'
            ]
        ]);
        $this->middleware('permission:zipcode-create|admin', [
            'only' => [
                'store'
            ]
        ]);
        $this->middleware('permission:zipcode-update|admin', [
            'only' => [
                'update',
                'restore'
            ]
        ]);
        $this->middleware('permission:zipcode-delete|admin', [
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

    public function getZipcode(Request $request)
    {
        return $this->apiService->getZipcode($request->all());
    }
}