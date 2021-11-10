<?php

namespace App\Services\ApiService\v1\MpisService\Transactions;

use App\Traits\ConsumeExternalService;

class IDSystem
{
    use ConsumeExternalService;

    public $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.mpis_base_uri');
    }

    public function createIdSystem($data)
    {
        return $this->performRequest('POST', '/mpis/id-system/create', $data);
    }

    public function getIdSystem($data)
    {
        return $this->performRequest('GET', '/mpis/id-system', $data);
    }

    public function showIdSystem($data)
    {
        return $this->performRequest('GET', '/mpis/id-system/show', $data);
    }
}