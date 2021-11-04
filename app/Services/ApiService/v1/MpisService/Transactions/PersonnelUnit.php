<?php

namespace App\Services\ApiService\v1\MpisService\Transactions;

use App\Traits\ConsumeExternalService;

class PersonnelUnit
{
    use ConsumeExternalService;

    public $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.mpis_base_uri');
    }

    public function createPersonnelUnit($data)
    {
        return $this->performRequest('POST', '/mpis/store-personnel-unit-assignment', $data);
    }
}