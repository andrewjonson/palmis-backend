<?php

namespace App\Services\ApiService\v1\MpisService\Transactions;

use App\Traits\ConsumeExternalService;

class CharacterReference
{
    use ConsumeExternalService;

    public $baseUrl;
    public $secret;

    public function __construct()
    {
        $this->baseUrl = config('services.mpis.base_url');
        $this->secret = config('services.mpis.secret');
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
        return $this->performRequest('PUT', '/mpis/update-reference/'.$id, $data);
    }

    public function deleteReference($id)
    {
        return $this->performRequest('DELETE', '/mpis/delete-reference/'.$id);
    }

    public function searchReference($data)
    {
        return $this->performRequest('GET', '/mpis/reference-dynamic-search', $data);
    }
}