<?php

namespace App\Services\ApiService\v1\SumisService\Transactions;

use App\Traits\ConsumeExternalService;

class Ris
{
    use ConsumeExternalService;

    public $baseUrl;
    public $secret;

    public function __construct()
    {
        $this->baseUrl = config('services.sumis.base_url');
        $this->secret = config('services.sumis.secret');
    }

    public function updateDirectiveItems($data)
    {
        return $this->performRequest('POST', '/sumis/update-directive-item', $data);
    }

    public function getRisList($data)
    {
        return $this->performRequest('GET', '/sumis/ris/get-list', $data);
    }

    public function getRisById($id)
    {
        return $this->performRequest('GET', '/sumis/ris/search/'.$id);
    }

    public function createRis($data, $id)
    {
        return $this->performRequest('POST', '/sumis/ris/create/'.$id, $data);
    }
} 