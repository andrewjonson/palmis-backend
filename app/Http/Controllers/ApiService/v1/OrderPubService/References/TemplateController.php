<?php

namespace App\Http\Controllers\ApiService\v1\OrderPubService\References;

use App\Http\Controllers\Controller;
use App\Traits\ConsumeExternalService;
use App\Traits\RestfulApiServiceControllerTrait;
use App\Services\ApiService\v1\OrderPubService\References\Template;

class TemplateController extends Controller
{
    use ConsumeExternalService, RestfulApiServiceControllerTrait;

    public function __construct(Template $apiService)
    {
        $this->middleware('permission:template-read|admin', [
            'only' => [
                'index',
                'onlyTrashed'
            ]
        ]);
        $this->middleware('permission:template-create|admin', [
            'only' => [
                'store'
            ]
        ]);
        $this->middleware('permission:template-update|admin', [
            'only' => [
                'update',
                'restore'
            ]
        ]);
        $this->middleware('permission:template-delete|admin', [
            'only' => [
                'delete',
                'forceDelete'
            ]
        ]);
        $this->apiService = $apiService;
    }
}