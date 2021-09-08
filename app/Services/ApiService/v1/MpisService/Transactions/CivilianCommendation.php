<?php

namespace App\Services\ApiService\v1\MpisService\Transactions;

use App\Traits\ConsumeExternalService;

class CivilianCommendation
{
    use ConsumeExternalService;

    public $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.mpis_base_uri');
    }

    public function getCommendation($id)
    {
        return $this->performRequest('GET', '/mpis/show-civilian-commendation/'.$id);
    }

    public function createCommendation($data)
    {
        return $this->performRequest('POST', '/mpis/store-civilian-commendation', $data);
    }
}