<?php

namespace App\Http\Controllers\ApiService\v1\OrderPubService\References;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ConsumeExternalService;
use App\Services\ApiService\v1\OrderPubService\References\DocumentSetting;

class DocumentSettingController extends Controller
{
    use ConsumeExternalService;

    public function __construct(DocumentSetting $apiService)
    {
        $this->middleware('permission:documentsetting-read|admin', [
            'only' => [
                'getDocumentSettingById',
            ]
        ]);
        $this->middleware('permission:documentsetting-create|admin', [
            'only' => [
                'storeDocumentSetting'
            ]
        ]);
        $this->middleware('permission:documentsetting-update|admin', [
            'only' => [
                'updateDocumentSetting',
            ]
        ]);

        $this->apiService = $apiService;
    }

    public function getDocumentSettingById($id)
    {
        return $this->apiService->getDocumentSettingById($id);
    }

    public function updateDocumentSetting(Request $request, $id)
    {
        return $this->apiService->updateDocumentSetting($request->all(), $id);
    }

    public function storeDocumentSetting(Request $request)
    {
        $logo = $request->logo->getClientOriginalName();
        $documentSetting = array_merge($request->all(),['logo' => $logo]);
        return $this->apiService->storeDocumentSetting($documentSetting);
    }
}