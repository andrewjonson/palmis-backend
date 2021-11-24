<?php

namespace App\Services\ApiService\v1\MpisService\Transactions;

use App\Traits\ConsumeExternalService;

class PersonalCharacteristic
{
    use ConsumeExternalService;

    public $baseUrl;
    public $secret;

    public function __construct()
    {
        $this->baseUrl = config('services.mpis.base_url');
        $this->secret = config('services.mpis.secret');
    }

    public function getPersonalCharacteristicById($id)
    {
        return $this->performRequest('GET', '/mpis/show-characteristic/'. $id);
    }

    public function createPersonalCharacteristic($data)
    {
        return $this->performRequest('POST', '/mpis/store-characteristic', $data);
    }
}