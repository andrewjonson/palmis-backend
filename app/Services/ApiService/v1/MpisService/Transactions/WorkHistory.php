<?php

namespace App\Services\ApiService\v1\MpisService\Transactions;

use App\Traits\ConsumeExternalService;

class WorkHistory
{
    use ConsumeExternalService;

    public $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.mpis_base_uri');
    }

    public function getWorkHistory($id)
    {
        return $this->performRequest('GET', '/mpis/show-work-history/'. $id);
    }

    public function createWorkHistory($data)
    {
        return $this->performRequest('POST', '/mpis/store-work', $data);
    }
}