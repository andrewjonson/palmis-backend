<?php

namespace App\Http\Controllers\ApiService\v1\SumisService\Transactions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ApiService\v1\SumisService\Transactions\StockCard;

class StockCardController extends Controller
{
    public function __construct(StockCard $apiService)
    {
        $this->apiService = $apiService;
    }

    public function getList(Request $request)
    {
        return $this->apiService->getList($request->all());
    }

    public function getStockCardById($id)
    {
        return $this->apiService->getStockCardById($id);
    }
}