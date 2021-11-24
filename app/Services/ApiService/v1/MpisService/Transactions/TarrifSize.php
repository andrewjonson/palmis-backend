<?php

namespace App\Services\ApiService\v1\MpisService\Transactions;

use App\Traits\ConsumeExternalService;

class TarrifSize
{
    use ConsumeExternalService;

    public $baseUrl;
    public $secret;

    public function __construct()
    {
        $this->baseUrl = config('services.mpis.base_url');
        $this->secret = config('services.mpis.secret');
    }

    public function getTarrifSizeById($id)
    {
        return $this->performRequest('GET', '/mpis/show-tariff-size/'. $id);
    }

    public function createTarrifSize($data)
    {
        return $this->performRequest('POST', '/mpis/store-tariff-size', $data);
    }
}