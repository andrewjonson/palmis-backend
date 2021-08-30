<?php

namespace App\Services\ApiService\v1\MpisService\Transactions;

use App\Traits\ConsumeExternalService;

class GovernmentId
{
    use ConsumeExternalService;

    public $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.mpis_base_uri');
    }

    public function getGovernmentId($id)
    {
        return $this->performRequest('GET', '/mpis/show-government/'.$id);
    }

    public function createGovernmentId($data)
    {
        return $this->performRequest('POST', '/mpis/store-government', $data);
    }
}