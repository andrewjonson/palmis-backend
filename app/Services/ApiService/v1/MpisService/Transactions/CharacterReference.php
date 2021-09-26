<?php

namespace App\Services\ApiService\v1\MpisService\Transactions;

use App\Traits\ConsumeExternalService;

class CharacterReference
{
    use ConsumeExternalService;

    public $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.mpis_base_uri');
    }

    public function getReference($id)
    {
        return $this->performRequest('GET', '/mpis/show-reference/'.$id);
    }

    public function createReference($data)
    {
        return $this->performRequest('POST', '/mpis/store-reference', $data);
    }

    public function updateReference($data, $id)
    {
        return $this->performRequest('POST', '/mpis/update-reference/'.$id, $data);
    }

    public function deleteReference($id)
    {
        return $this->performRequest('POST', '/mpis/delete-reference/'.$id);
    }
}