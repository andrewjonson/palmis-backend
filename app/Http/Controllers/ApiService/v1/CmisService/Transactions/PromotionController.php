<?php

namespace App\Http\Controllers\ApiService\v1\CmisService\Transactions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ConsumeExternalService;
use App\Services\ApiService\v1\CmisService\Transactions\Promotion;

class PromotionController extends Controller
{
    use ConsumeExternalService;

    public function __construct(Promotion $apiService)
    {
        $this->middleware('permission:promotion-read|admin', [
            'only' => [
                'getPromotion',
                'onlyTrashedPromotion',
                'getPromotablePersonnel',
                'getPromotablePerPersonnel'
            ]
        ]);
        $this->middleware('permission:promotion-create|admin', [
            'only' => [
                'createPromotion'
            ]
        ]);
        $this->middleware('permission:promotion-update|admin', [
            'only' => [
                'updatePromotion',
                'restorePromotion'
            ]
        ]);
        $this->middleware('permission:promotion-delete|admin', [
            'only' => [
                'softDeletePromotion',
                'forceDeletePromotion'
            ]
        ]);
        $this->apiService = $apiService;
    }

    public function getPromotion(Request $request)
    {
        return $this->apiService->getPromotion($request->all());
    }

    public function createPromotion(Request $request)
    {
        return $this->apiService->createPromotion($request->all());
    }

    public function updatePromotion(Request $request, $id)
    {
        return $this->apiService->updatePromotion($request->all(), $id);
    }

    public function softDeletePromotion($id)
    {
        return $this->apiService->softDeletePromotion($id);
    }

    public function onlyTrashedPromotion(Request $request)
    {
        return $this->apiService->onlyTrashedPromotion($request->all());
    }

    public function restorePromotion($id)
    {
        return $this->apiService->restorePromotion($id);
    }

    public function forceDeletePromotion($id)
    {
        return $this->apiService->forceDeletePromotion($id);
    }

    public function getPromotablePersonnel(Request $request)
    {
        return $this->apiService->getPromotablePersonnel($request->all());
    }

    public function getPromotablePerPersonnel(Request $request)
    {
        return $this->apiService->getPromotablePerPersonnel($request->all());
    }
}