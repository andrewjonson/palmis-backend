<?php

namespace App\Services\ApiService\v1\MpisService\Transactions;

use App\Traits\ConsumeExternalService;

class CountryVisited
{
    use ConsumeExternalService;

    public $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.mpis_base_uri');
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