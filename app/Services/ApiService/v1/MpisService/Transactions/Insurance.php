<?php

namespace App\Services\ApiService\v1\MpisService\Transactions;

use App\Traits\ConsumeExternalService;

class Insurance
{
    use ConsumeExternalService;

    public $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.mpis_base_uri');
    }

    public function getInsurance($id)
    {
        return $this->performRequest('GET', '/mpis/show-insurance/'.$id);
    }

    public function createInsurance($data)
    {
        return $this->performRequest('POST', '/mpis/store-insurance', $data);
    }
}