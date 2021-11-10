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

    public function createPersonnelEnlistment($data)
    {
        return $this->performRequest('POST', '/mpis/create-personnel-enlistment', $data);
    }

    public function createPersonnelReenlistment($data)
    {
        return $this->performRequest('POST', '/mpis/create-personnel-reenlistment', $data);
    }

    public function showPersonnelEnlistmentById($id)
    {
        return $this->performRequest('GET', '/mpis/show-personnel-enlistment/'. $id);
    }

    public function showPersonnelEnlistmentDetailById($id)
    {
        return $this->performRequest('GET', '/mpis/show-order-detail-enlistment/'. $id);
    }
}