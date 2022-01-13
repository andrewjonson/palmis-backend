<?php

namespace App\Http\Controllers\ApiService\v1\SumisService\Reports;

use App\Http\Controllers\Controller;
use App\Services\ApiService\v1\SumisService\Reports\IarReport;

class IarReportController extends Controller
{
    public function __construct(IarReport $apiService)
    {
        $this->apiService = $apiService;
    }

    public function getReportIar($id)
    {
        return $this->apiService->getReportIar($id);
    }
}