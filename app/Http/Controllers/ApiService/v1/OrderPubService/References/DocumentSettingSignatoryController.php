<?php

namespace App\Http\Controllers\ApiService\v1\OrderPubService\References;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ConsumeExternalService;
use App\Services\ApiService\v1\OrderPubService\References\DocumentSettingSignatory;

class DocumentSettingSignatoryController extends Controller
{
    use ConsumeExternalService;

    public function __construct(DocumentSettingSignatory $apiService)
    {
        $this->middleware('permission:documentsettingsignatory-read|admin', [
            'only' => [
                'index',
                'onlyTrashed'
            ]
        ]);
        $this->middleware('permission:documentsettingsignatory-create|admin', [
            'only' => [
                'store'
            ]
        ]);
        $this->middleware('permission:documentsettingsignatory-update|admin', [
            'only' => [
                'update',
                'restore'
            ]
        ]);
        $this->middleware('permission:documentsettingsignatory-delete|admin', [
            'only' => [
                'delete',
                'forceDelete'
            ]
        ]);
        $this->apiService = $apiService;
    }

    public function index()
    {
        return $this->apiService->index();
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