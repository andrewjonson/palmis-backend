<?php

namespace App\Services\ApiService\v1\MpisService\Transactions;

use App\Traits\ConsumeExternalService;

class CountryVisited
{
    use ConsumeExternalService;

    public $baseUrl;
    public $secret;

    public function __construct()
    {
        $this->baseUrl = config('services.mpis.base_url');
        $this->secret = config('services.mpis.secret');
    }

    public function getCountryVisited($id)
    {
        return $this->performRequest('GET', '/mpis/show-country-visited/'.$id);
    }

    public function createCountryVisited($data)
    {
        return $this->performRequest('POST', '/mpis/store-country', $data);
    }
}