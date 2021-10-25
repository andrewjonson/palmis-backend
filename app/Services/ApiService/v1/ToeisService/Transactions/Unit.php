<?php

namespace App\Services\ApiService\v1\ToeisService\Transactions;

use App\Traits\ConsumeExternalService;

class Unit
{
    use ConsumeExternalService;

    public $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.toeis_base_uri');
    }

    public function index($data)
    {
        return $this->performRequest('GET', '/toeis/unit-all-active', $data);
    }

    public function getUnitById($id)
    {
        return $this->performRequest('GET', 'toeis/unit-per-id/'.$id);
    }

    public function getUnitConcatById($id)
    {
        return $this->performRequest('GET', 'toeis/unit-concat/'.$id);
    }
}