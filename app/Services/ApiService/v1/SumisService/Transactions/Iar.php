<?php

namespace App\Services\ApiService\v1\SumisService\Transactions;

use App\Traits\ConsumeExternalService;

class Iar
{
    use ConsumeExternalService;

    public $baseUrl;
    public $secret;

    public function __construct()
    {
        $this->baseUrl = config('services.sumis.base_url');
        $this->secret = config('services.sumis.secret');
    }

    public function create($data, $id)
    {
        return $this->performRequest('POST', '/sumis/iar/create/'.$id, $data);
    }

    public function getInventoryByTallyId($id)
    {
        return $this->performRequest('GET', '/sumis/iar/get-inventory/'.$id);
    }

    public function getByTallyId($id)
    {
        return $this->performRequest('GET', '/sumis/iar/tally-inventory/'.$id);
    }

    public function getIarList($data)
    {
        return $this->performRequest('GET', '/sumis/iar/get-list', $data);
    }
}