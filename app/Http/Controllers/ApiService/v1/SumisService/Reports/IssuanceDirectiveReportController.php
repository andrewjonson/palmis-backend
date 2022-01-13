<?php

namespace App\Http\Controllers\ApiService\v1\SumisService\Reports;

use App\Http\Controllers\Controller;
use App\Services\ApiService\v1\SumisService\Reports\IssuanceDirectiveReport;

class IssuanceDirectiveReportController extends Controller
{
    public function __construct(IssuanceDirectiveReport $apiService)
    {
        $this->apiService = $apiService;
    }

    public function getReportIssuanceDirective($id)
    {
        return $this->apiService->getReportIssuanceDirective($id);
    }
}