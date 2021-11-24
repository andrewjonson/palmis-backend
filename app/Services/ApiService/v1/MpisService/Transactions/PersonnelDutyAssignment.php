<?php

namespace App\Services\ApiService\v1\MpisService\Transactions;

use App\Traits\ConsumeExternalService;

class PersonnelDutyAssignment
{
    use ConsumeExternalService;

    public $baseUrl;
    public $secret;

    public function __construct()
    {
        $this->baseUrl = config('services.mpis.base_url');
        $this->secret = config('services.mpis.secret');
    }

    public function createDutyAssignment($data)
    {
        return $this->performRequest('POST', '/mpis/store-personnel-duty-assignment', $data);
    }

    public function showDutyAssignmentById($id)
    {
        return $this->performRequest('GET', '/mpis/show-personnel-duty-assignment/'. $id);
    }

    public function showDutyAssignmentDetailById($id)
    {
        return $this->performRequest('GET', '/mpis/show-order-duty-assignment-detail/'. $id);
    }

}