<?php

namespace App\Services\ApiService\v1\MpisService\Transactions;

use App\Traits\ConsumeExternalService;

class IDSystem
{
    use ConsumeExternalService;

    public $baseUrl;
    public $secret;

    public function __construct()
    {
        $this->baseUrl = config('services.mpis.base_url');
        $this->secret = config('services.mpis.secret');
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

    public function searchIdSystem($id)
    {
        return $this->performRequest('GET', '/mpis/id-system-search-id/'. $id);
    }
}