<?php

namespace App\Services\ApiService\v1\MpisService\Transactions;

use App\Traits\ConsumeExternalService;

class PersonnelEnlistment
{
    use ConsumeExternalService;

    public $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.mpis_base_uri');
    }

    public function createEnlistment($data)
    {
        return $this->performRequest('POST', '/mpis/create-enlistment', $data);
    }

    public function createPersonnelEnlistment($data)
    {
        return $this->performRequest('POST', '/mpis/create-personnel-enlistment', $data);
    }
}