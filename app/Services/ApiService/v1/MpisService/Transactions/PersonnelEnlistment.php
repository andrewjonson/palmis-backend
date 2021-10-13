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
        return $this->performRequest('GET', '/mpis/create-enlistment', $data);
    }
}