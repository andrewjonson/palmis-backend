<?php

namespace App\Services\ApiService\v1\MpisService\Transactions;

use App\Traits\ConsumeExternalService;

class PersonnelRank
{
    use ConsumeExternalService;

    public $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.mpis_base_uri');
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