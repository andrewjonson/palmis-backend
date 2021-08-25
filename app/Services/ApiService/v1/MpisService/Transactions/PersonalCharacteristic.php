<?php

namespace App\Services\ApiService\v1\MpisService\Transactions;

use App\Traits\ConsumeExternalService;

class PersonalCharacteristic
{
    use ConsumeExternalService;

    public $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.mpis_base_uri');
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