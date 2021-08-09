<?php

namespace App\Http\Controllers\ApiService\v1\OrderPubService\References;

use App\Http\Controllers\Controller;
use App\Traits\ConsumeExternalService;
use App\Traits\RestfulApiServiceControllerTrait;
use App\Services\ApiService\v1\OrderPubService\References\ModelList;

class ModelListController extends Controller
{
    use ConsumeExternalService, RestfulApiServiceControllerTrait;

    public function __construct(ModelList $apiService)
    {
        $this->middleware('permission:modellist-read|admin', [
            'only' => [
                'index',
                'getModelbyType'
            ]
        ]);
        $this->apiService = $apiService;
    }

    public function index(Request $request)
    {
        return $this->apiService->index($request->all());
    }

    public function getModelbyType($typeId)
    {
        return $this->apiService->getModelbyType($typeId);
    }

}