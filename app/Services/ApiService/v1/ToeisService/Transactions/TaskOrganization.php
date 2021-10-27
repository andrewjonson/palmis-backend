<?php

namespace App\Services\ApiService\v1\ToeisService\Transactions;

use App\Traits\ConsumeExternalService;

class TaskOrganization
{
    use ConsumeExternalService;

    public $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.toeis_base_uri');
    }

    public function createTaskOrg($data)
    {
        return $this->performRequest('POST', '/toeis/unit-task-org', $data);
    }
}