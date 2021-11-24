<?php

namespace App\Services\ApiService\v1\MpisService\Transactions;

use App\Traits\ConsumeExternalService;

class CivilianCommendation
{
    use ConsumeExternalService;

    public $baseUrl;
    public $secret;

    public function __construct()
    {
        $this->baseUrl = config('services.mpis.base_url');
        $this->secret = config('services.mpis.secret');
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