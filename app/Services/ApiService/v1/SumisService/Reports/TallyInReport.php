<?php

namespace App\Services\ApiService\v1\SumisService\Reports;

use App\Traits\ConsumeExternalService;

class TallyInReport
{
    use ConsumeExternalService;

    public $baseUrl;
    public $secret;

    public function __construct()
    {
        $this->baseUrl = config('services.sumis.base_url');
        $this->secret = config('services.sumis.secret');
    }

    public function getReportTallyIn($id)
    {
        return $this->performRequest('GET', '/sumis/report/tally-in/'.$id);
    }
}