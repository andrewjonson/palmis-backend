<?php

namespace App\Services\ApiService\v1\MpisService\References;

use App\Traits\ConsumeExternalService;

class CivilStatus
{
    use ConsumeExternalService;

    public $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.mpis_base_uri');
    }

    public function index($data)
    {
        return $this->performRequest('GET', '/mpis/civil-status', $data);
    }

    public function store($data)
    {
        return $this->performRequest('POST', '/mpis/civil-status', $data);
    }

    public function update($data, $id)
    {
        return $this->performRequest('PUT', '/mpis/civil-status/'.$id, $data);
    }

    public function delete($id)
    {
        return $this->performRequest('DELETE', '/mpis/civil-status/'.$id);
    }

    public function onlyTrashed($data)
    {
        return $this->performRequest('GET', '/mpis/civil-status/only-trashed', $data);
    }

    public function restore($id)
    {
        return $this->performRequest('PUT', '/mpis/civil-statuss/restore/'.$id);
    }

    public function forceDelete($id)
    {
        return $this->performRequest('DELETE', '/mpis/civil-status/force-delete/'.$id);
    }

    public function searchCivilStatus($data)
    {
        return $this->performRequest('GET', '/mpis/civil-status-search', $data);
    }
}