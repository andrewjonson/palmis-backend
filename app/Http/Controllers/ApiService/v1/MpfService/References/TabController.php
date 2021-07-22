<?php

namespace App\Http\Controllers\ApiService\v1\MpfService\References;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ConsumeExternalService;
use App\Services\ApiService\v1\MpfService\References\Tab;

class TabController extends Controller
{
    use ConsumeExternalService;

    public function __construct(Tab $apiService)
    {
        $this->middleware('permission:tab-read|admin', [
            'only' => [
                'getTab'
            ]
        ]);
        $this->middleware('permission:tab-create|admin', [
            'only' => [
                'createTab'
            ]
        ]);
        $this->apiService = $apiService;
    }

    public function getTab($id)
    {
        return $this->apiService->getTab($id);
    }

    public function createTab(Request $request)
    {
        return $this->apiService->createTab($request->all());
    }
}