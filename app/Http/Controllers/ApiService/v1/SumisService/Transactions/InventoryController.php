<?php

namespace App\Http\Controllers\ApiService\v1\SumisService\Transactions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ApiService\v1\SumisService\Transactions\Inventory;

class InventoryController extends Controller
{
    public function __construct(Inventory $apiService)
    {
        $this->apiService = $apiService;
    }

    public function get(Request $request)
    {
        return $this->apiService->get($request->all());
    }

    public function searchLotNr(Request $request)
    {
        return $this->apiService->searchLotNr($request->all());
    }
}