<?php

namespace App\Services\ApiService\v1\MpisService\Transactions;

use App\Traits\ConsumeExternalService;

class PersonnelRank
{
    use ConsumeExternalService;

    public $baseUrl;
    public $secret;

    public function __construct()
    {
        $this->baseUrl = config('services.mpis.base_url');
        $this->secret = config('services.mpis.secret');
    }

    public function createPersonnelRank($data)
    {
        return $this->performRequest('GET', '/mpis/search-personnel-serial', $data);
    }

    public function searchPersonnelRank($data)
    {
        return $this->performRequest('POST', '/mpis/create-personnel-rank', $data);
    }
}