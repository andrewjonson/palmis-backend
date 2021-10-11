<?php

namespace App\Http\Controllers\ApiService\v1\OrderPubService\Transactions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ConsumeExternalService;
use App\Services\ApiService\v1\OrderPubService\Transactions\OrderRoute;

class OrderRouteController extends Controller
{
    use ConsumeExternalService;

    public function __construct(OrderRoute $apiService)
    {
        $this->middleware('permission:order-read|admin', [
            'only' => [
                'showOrderRoute',
                'showRouteOrders'
            ]
        ]);
        $this->middleware('permission:orderroute-create|admin', [
            'only' => [
                'routeOrder'
            ]
        ]);
        $this->middleware('permission:orderroute-update|admin', [
            'only' => [
                'saveRemarks'
            ]
        ]);
        $this->apiService = $apiService;
    }

    public function routeOrder($id)
    {
        return $this->apiService->routeOrder($id);
    }

    public function saveRemarks(Request $request, $id)
    {
        return $this->apiService->saveRemarks($request->all(), $id);
    }

    public function showOrderRoute($id)
    {
        return $this->apiService->showOrderRoute($id);
    }

    public function showRouteOrders(Request $request)
    {
        return $this->apiService->showRouteOrders($request->all());
    }
}