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
                'getDocumentSetting',
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

    public function getDocumentSetting()
    {
        return $this->apiService->getDocumentSetting();
    }

    public function updateDocumentSetting(Request $request, $id)
    {
        return $this->apiService->updateDocumentSetting($request->all(), $id);
    }

    public function storeDocumentSetting(Request $request)
    {
        if ($request->logo){
            $logo = $request->logo->getClientOriginalName();
            $request->logo->move(public_path('orderpub/images/'), $logo);
            $documentSetting = array_merge($request->all(),['logo' => $logo]);
            return $this->apiService->storeDocumentSetting($documentSetting);
        }

        return $this->apiService->storeDocumentSetting($request->all());
    }
}