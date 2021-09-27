<?php

namespace App\Http\Controllers\ApiService\v1\OrderPubService\References;

use App\Http\Controllers\Controller;
use App\Traits\ConsumeExternalService;
use App\Traits\RestfulApiServiceControllerTrait;
use App\Services\ApiService\v1\OrderPubService\References\Type;

class TypeController extends Controller
{
    use ConsumeExternalService, RestfulApiServiceControllerTrait;

    public function __construct(Type $apiService)
    {
        $this->middleware('permission:type-read|admin', [
            'only' => [
                'index',
                'onlyTrashed',
                'getTypeByCategory',
                'getTypeById',
                'getTypeWithTemplates',
                'getModelByType'

            ]
        ]);
        $this->middleware('permission:type-create|admin', [
            'only' => [
                'store'
            ]
        ]);
        $this->middleware('permission:type-update|admin', [
            'only' => [
                'update',
                'restore'
            ]
        ]);
        $this->middleware('permission:type-delete|admin', [
            'only' => [
                'delete',
                'forceDelete'
            ]
        ]);
        $this->apiService = $apiService;
    }

    public function getTypeByCategory($id)
    {
        return $this->apiService->getTypeByCategory($id);
    }

    public function getTypeById($id)
    {
        return $this->apiService->getTypeById($id);
    }

    public function getTypeWithTemplates($id)
    {
        return $this->apiService->getTypeWithTemplates($id);
    }

    public function getModelByType($id)
    {
        return $this->apiService->getModelByType($id);
    }
}