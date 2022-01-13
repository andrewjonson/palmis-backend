<?php

namespace App\Http\Controllers\ApiService\v1\SumisService\Reports;

use App\Http\Controllers\Controller;
use App\Services\ApiService\v1\SumisService\Reports\StockCardReport;

class StockCardReportController extends Controller
{
    public function __construct(StockCardReport $apiService)
    {
        $this->apiService = $apiService;
    }

    public function getReportStockCard($id)
    {
        return $this->apiService->getReportStockCard($id);
    }
}