<?php

namespace App\Services\ApiService\v1\MpisService\Transactions;

use App\Traits\ConsumeExternalService;

class PersonnelAward
{
    use ConsumeExternalService;

    public $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.mpis_base_uri');
    }

    public function createPersonnelRank($data)
    {
        return $this->performRequest('POST', '/mpis/store-personnel-award', $data);
    }

    public function showPersonnelAward($id)
    {
        return $this->performRequest('GET', '/mpis/show-personnel-award/'. $id);
    }

    public function getAppurtenance($data)
    {
        return $this->performRequest('GET', '/mpis/get-award-appurtenance', $data);
    }
}