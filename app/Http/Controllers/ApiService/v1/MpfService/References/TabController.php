<?php

namespace App\Http\Controllers\ApiService\v1\MpfService\References;

use App\Http\Controllers\Controller;
use App\Traits\ConsumeExternalService;
use App\Services\ApiService\v1\MpfService\References\Tab;

class TabController extends Controller
{
    use ConsumeExternalService;

    public function __construct(Tab $apiService)
    {
        $this->middleware('permission:subcategory-read|admin', [
            'only' => [
                'getTab'
            ]
        ]);
        $this->apiService = $apiService;
    }

    public function getTab($id)
    {
        return $this->apiService->getTab($id);
    }
}