<?php

namespace App\Services\ApiService\v1\SumisService\Transactions;

use App\Traits\ConsumeExternalService;

class Inventory
{
    use ConsumeExternalService;

    public $baseUrl;
    public $secret;

    public function __construct()
    {
        $this->baseUrl = config('services.sumis.base_url');
        $this->secret = config('services.sumis.secret');
    }

    public function get($data)
    {
        return $this->performRequest('GET', '/sumis/inventory', $data);
    }

    public function searchLotNr($data)
    {
        return $this->performRequest('GET', '/sumis/inventory/search-lotnr', $data);
    }
}