<?php

namespace App\Services\ApiService\v1\MpisService\References;

use App\Traits\ConsumeExternalService;

class Ethnic
{
    use ConsumeExternalService;

    public $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.mpis_base_uri');
    }

    public function index($data)
    {
        return $this->performRequest('GET', '/mpis/ethnic', $data);
    }

    public function store($data)
    {
        return $this->performRequest('POST', '/mpis/ethnic', $data);
    }

    public function update($data, $id)
    {
        return $this->performRequest('PUT', '/mpis/ethnic/'.$id, $data);
    }

    public function delete($id)
    {
        return $this->performRequest('DELETE', '/mpis/ethnic/'.$id);
    }

    public function onlyTrashed($data)
    {
        return $this->performRequest('GET', '/mpis/ethnic/only-trashed', $data);
    }

    public function restore($id)
    {
        return $this->performRequest('PUT', '/mpis/ethnic/restore/'.$id);
    }

    public function forceDelete($id)
    {
        return $this->performRequest('DELETE', '/mpis/ethnic/force-delete/'.$id);
    }

    public function searchEthnic($data)
    {
        return $this->performRequest('GET', '/mpis/ethnic-code-search', $data);
    }
}