<?php

namespace App\Services\ApiService\v1\MpisService\References;

use App\Traits\ConsumeExternalService;

class PersonnelGroup
{
    use ConsumeExternalService;

    public $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.mpis_base_uri');
    }

    public function index($data)
    {
        return $this->performRequest('GET', '/mpis/personnel-group', $data);
    }

    public function store($data)
    {
        return $this->performRequest('POST', '/mpis/personnel-group', $data);
    }

    public function update($data, $id)
    {
        return $this->performRequest('PUT', '/mpis/personnel-group/'.$id, $data);
    }

    public function delete($id)
    {
        return $this->performRequest('DELETE', '/mpis/personnel-group/'.$id);
    }

    public function onlyTrashed($data)
    {
        return $this->performRequest('GET', '/mpis/personnel-group/only-trashed', $data);
    }

    public function restore($id)
    {
        return $this->performRequest('PUT', '/mpis/personnel-group/restore/'.$id);
    }

    public function forceDelete($id)
    {
        return $this->performRequest('DELETE', '/mpis/personnel-group/force-delete/'.$id);
    }

    public function searchPersonnelGroup($data)
    {
        return $this->performRequest('GET', '/mpis/personnel-group-search', $data);
    }
}