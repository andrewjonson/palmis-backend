<?php

namespace App\Http\Controllers\ApiService\v1\SumisService\Reports;

use App\Http\Controllers\Controller;
use App\Services\ApiService\v1\SumisService\Reports\TallyInReport;

class TallyInReportController extends Controller
{
    public function __construct(TallyInReport $apiService)
    {
        $this->apiService = $apiService;
    }

    public function getReportTallyIn($id)
    {
        return $this->apiService->getReportTallyIn($id);
    }
}