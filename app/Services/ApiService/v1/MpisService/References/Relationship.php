<?php

namespace App\Services\ApiService\v1\MpisService\References;

use App\Traits\ConsumeExternalService;

class Relationship
{
    use ConsumeExternalService;

    public $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.mpis_base_uri');
    }

    public function index($data)
    {
        return $this->performRequest('GET', '/mpis/relationship', $data);
    }

    public function store($data)
    {
        return $this->performRequest('POST', '/mpis/relationship', $data);
    }

    public function update($data, $id)
    {
        return $this->performRequest('PUT', '/mpis/relationship/'.$id, $data);
    }

    public function delete($id)
    {
        return $this->performRequest('DELETE', '/mpis/relationship/'.$id);
    }

    public function onlyTrashed($data)
    {
        return $this->performRequest('GET', '/mpis/relationship/only-trashed', $data);
    }

    public function restore($id)
    {
        return $this->performRequest('PUT', '/mpis/relationship/restore/'.$id);
    }

    public function forceDelete($id)
    {
        return $this->performRequest('DELETE', '/mpis/relationship/force-delete/'.$id);
    }

    public function searchRelationship($data)
    {
        return $this->performRequest('GET', '/mpis/relationship-search', $data);
    }
}