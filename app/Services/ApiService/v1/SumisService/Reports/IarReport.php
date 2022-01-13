<?php

namespace App\Services\ApiService\v1\SumisService\Reports;

use App\Traits\ConsumeExternalService;

class IarReport
{
    use ConsumeExternalService;

    public $baseUrl;
    public $secret;

    public function __construct()
    {
        $this->baseUrl = config('services.sumis.base_url');
        $this->secret = config('services.sumis.secret');
    }

    public function getReportIar($id)
    {
        return $this->performRequest('GET', '/sumis/report/iar/'.$id);
    }
}