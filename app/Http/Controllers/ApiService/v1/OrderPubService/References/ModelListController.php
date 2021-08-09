<?php

namespace App\Http\Controllers\ApiService\v1\OrderPubService\References;

use App\Http\Controllers\Controller;
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

    public function index($data)
    {
        return $this->apiService->index($data);
    }

    public function getModelbyType($typeId)
    {
        return $this->apiService->getModelbyType($tabId);
    }

}