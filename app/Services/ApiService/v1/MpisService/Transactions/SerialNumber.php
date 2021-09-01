<?php

namespace App\Services\ApiService\v1\MpisService\Transactions;

use App\Traits\ConsumeExternalService;

class SerialNumber
{
    use ConsumeExternalService;

    public $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.mpis_base_uri');
    }

    public function createSerialNumber($data)
    {
        return $this->performRequest('POST', '/mpis/create-serial', $data);
    }
}