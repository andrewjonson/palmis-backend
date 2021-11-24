<?php

namespace App\Services\ApiService\v1\MpisService\Transactions;

use App\Traits\ConsumeExternalService;

class PersonnelUnitAssignment
{
    use ConsumeExternalService;

    public $baseUrl;
    public $secret;

    public function __construct()
    {
        $this->baseUrl = config('services.mpis.base_url');
        $this->secret = config('services.mpis.secret');
    }

    public function createUnitAssignment($data)
    {
        return $this->performRequest('POST', '/mpis/store-personnel-unit-assignment', $data);
    }

    public function showUnitAssignmentById($id)
    {
        return $this->performRequest('GET', '/mpis/show-personnel-unit-assignment/'. $id);
    }

    public function showUnitAssignmentDetailById($id)
    {
        return $this->performRequest('GET', '/mpis/show-order-unit-assignment-detail/'. $id);
    }

}