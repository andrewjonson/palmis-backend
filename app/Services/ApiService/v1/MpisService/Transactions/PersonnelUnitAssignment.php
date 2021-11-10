<?php

namespace App\Services\ApiService\v1\MpisService\Transactions;

use App\Traits\ConsumeExternalService;

class PersonnelUnitAssignment
{
    use ConsumeExternalService;

    public $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.mpis_base_uri');
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