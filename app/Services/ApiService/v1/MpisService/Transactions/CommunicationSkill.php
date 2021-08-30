<?php

namespace App\Services\ApiService\v1\MpisService\Transactions;

use App\Traits\ConsumeExternalService;

class CommunicationSkill
{
    use ConsumeExternalService;

    public $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.mpis_base_uri');
    }

    public function getCommunicationSkill($id)
    {
        return $this->performRequest('GET', '/mpis/show-communication/'.$id);
    }

    public function createCommunicationSkill($data)
    {
        return $this->performRequest('POST', '/mpis/store-communication', $data);
    }

}