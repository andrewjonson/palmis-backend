<?php

namespace App\Http\Controllers\ApiService\v1\MpfService\References;

use App\Http\Controllers\Controller;
use App\Traits\ConsumeExternalService;
use App\Traits\RestfulApiServiceControllerTrait;
use App\Services\ApiService\v1\MpfService\References\SubCategory;

class SubCategoryController extends Controller
{
    use ConsumeExternalService, RestfulApiServiceControllerTrait;

    public function __construct(SubCategory $apiService)
    {
        $this->middleware('permission:subcategory-read|admin', [
            'only' => [
                'index',
                'onlyTrashed'
            ]
        ]);
        $this->middleware('permission:subcategory-create|admin', [
            'only' => [
                'store'
            ]
        ]);
        $this->middleware('permission:subcategory-update|admin', [
            'only' => [
                'update',
                'restore'
            ]
        ]);
        $this->middleware('permission:subcategory-delete|admin', [
            'only' => [
                'delete',
                'forceDelete'
            ]
        ]);
        $this->apiService = $apiService;
    }
}