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
        return $this->performRequest('GET', '/toeis/unit', $data);
    }

    public function store($data)
    {
        return $this->performRequest('POST', '/toeis/unit', $data);
    }
}