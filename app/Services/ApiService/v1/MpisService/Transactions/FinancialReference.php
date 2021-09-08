<?php

namespace App\Services\ApiService\v1\MpisService\Transactions;

use App\Traits\ConsumeExternalService;

class FinancialReference
{
    use ConsumeExternalService;

    public $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.mpis_base_uri');
    }

    public function getFinancialReference($id)
    {
        return $this->performRequest('GET', '/mpis/show-financial/'.$id);
    }

    public function createFinancialReference($data)
    {
        return $this->performRequest('POST', '/mpis/store-financial', $data);
    }
}