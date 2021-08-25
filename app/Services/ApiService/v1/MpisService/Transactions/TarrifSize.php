<?php

namespace App\Services\ApiService\v1\MpisService\Transactions;

use App\Traits\ConsumeExternalService;

class TarrifSize
{
    use ConsumeExternalService;

    public $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.mpis_base_uri');
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