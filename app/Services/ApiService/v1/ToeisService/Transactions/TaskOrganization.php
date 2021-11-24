<?php

namespace App\Services\ApiService\v1\ToeisService\Transactions;

use App\Traits\ConsumeExternalService;

class TaskOrganization
{
    use ConsumeExternalService;

    public $baseUrl;
    public $secret;

    public function __construct()
    {
        $this->baseUrl = config('services.toeis.base_url');
        $this->secret = config('services.toeis.secret');
    }

    public function createTaskOrg($data)
    {
        return $this->performRequest('POST', '/toeis/unit-task-org', $data);
    }
}