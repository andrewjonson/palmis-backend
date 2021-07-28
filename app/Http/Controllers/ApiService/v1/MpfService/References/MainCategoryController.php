<?php

namespace App\Http\Controllers\ApiService\v1\MpfService\References;

use App\Http\Controllers\Controller;
use App\Traits\ConsumeExternalService;
use App\Traits\RestfulApiServiceControllerTrait;
use App\Services\ApiService\v1\MpfService\References\MainCategory;

class MainCategoryController extends Controller
{
    use ConsumeExternalService, RestfulApiServiceControllerTrait;

    public function __construct(MainCategory $apiService)
    {
        $this->middleware('permission:maincategory-read|admin', [
            'only' => [
                'index',
                'onlyTrashed'
            ]
        ]);
        $this->middleware('permission:maincategory-create|admin', [
            'only' => [
                'store'
            ]
        ]);
        $this->middleware('permission:maincategory-update|admin', [
            'only' => [
                'update',
                'restore'
            ]
        ]);
        $this->middleware('permission:maincategory-delete|admin', [
            'only' => [
                'delete',
                'forceDelete'
            ]
        ]);
        $this->apiService = $apiService;
    }
}