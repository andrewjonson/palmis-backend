<?php

namespace App\Http\Controllers\ApiService\v1\OrderPubService\Transactions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ConsumeExternalService;
use App\Services\ApiService\v1\OrderPubService\Transactions\Order;

class OrderController extends Controller
{
    use ConsumeExternalService;

    public function __construct(Order $apiService)
    {
        $this->middleware('permission:order-read|admin', [
            'only' => [
                'getOrders',
                'viewPublishOrder',
                'viewDraftOrder',
                'saveOrderAsTemplate',
                'getDraftOrders',
                'getPublishedOrders',
                'getOrderHistories'
            ]
        ]);
        $this->middleware('permission:order-create|admin', [
            'only' => [
                'createGeneralOrder'
            ]
        ]);
        $this->middleware('permission:order-update|admin', [
            'only' => [
                'publishOrder',
                'reviseGeneralOrder'
            ]
        ]);
        $this->apiService = $apiService;
    }

    public function getOrders(Request $request)
    {
        return $this->apiService->getOrders($request->all());
    }

    public function createGeneralOrder(Request $request, $id)
    {
        return $this->apiService->createGeneralOrder($request->all(), $id);
    }

    public function reviseGeneralOrder(Request $request, $id)
    {
        return $this->apiService->reviseGeneralOrder($request->all(), $id);
    }

    public function publishOrder($id)
    {
        return $this->apiService->publishOrder($id);
    }

    public function viewPublishOrder($id)
    {
        return $this->apiService->viewPublishOrder($id);
    }

    public function viewDraftOrder($versionId)
    {
        return $this->apiService->viewDraftOrder($versionId);
    }

    public function saveOrderAsTemplate(Request $request, $id)
    {
        return $this->apiService->saveOrderAsTemplate($request->all(), $id);
    }

    public function getDraftOrders(Request $request)
    {
        return $this->apiService->getDraftOrders($request->all());
    }

    public function getPublishedOrders(Request $request)
    {
        return $this->apiService->getPublishedOrders($request->all());
    }

    public function getOrderHistories($id)
    {
        return $this->apiService->getOrderHistories($id);
    }
}