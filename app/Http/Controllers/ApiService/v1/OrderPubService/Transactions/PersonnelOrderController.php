<?php

namespace App\Http\Controllers\ApiService\v1\OrderPubService\Transactions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ConsumeExternalService;
use App\Services\ApiService\v1\OrderPubService\Transactions\PersonnelOrder;

class PersonnelOrderController extends Controller
{
    use ConsumeExternalService;

    public function __construct(PersonnelOrder $apiService)
    {
        $this->middleware('permission:personnelorder-read|admin', [
            'only' => [
                'getOrderByOrderCode'
            ]
        ]);
        $this->apiService = $apiService;
    }

    public function getOrderByOrderCode($orderCode)
    {
        return $this->apiService->getOrderByOrderCode($orderCode);
    }
}