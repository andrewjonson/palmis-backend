<?php

namespace App\Http\Controllers\ApiService\v1\OrderPubService\References;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ConsumeExternalService;
use App\Services\ApiService\v1\OrderPubService\References\DocumentSetting;
use App\Http\Requests\ApiRequest\v1\OrderPubRequest\Transactions\DocumentSettingRequest;

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

    public function storeDocumentSetting(DocumentSettingRequest $request)
    {
        if ($request->logo) {
            $data = $request->except('logo');
            $data['logo'] = time().'.'.$request->logo->getClientOriginalExtension();
            $request->logo->move(public_path('orderpub/images'), $data['logo']);
            return $this->apiService->storeDocumentSetting($data);
        }

        return $this->apiService->storeDocumentSetting($request->all());
    }
}