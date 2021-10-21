<?php

namespace App\Services\ApiService\v1\MpisService\References;

use App\Traits\ConsumeExternalService;

class Assignment
{
    use ConsumeExternalService;

    public $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.mpis_base_uri');
    }

    public function index($data)
    {
        return $this->performRequest('GET', '/mpis/assignment', $data);
    }

    public function store($data)
    {
        return $this->performRequest('POST', '/mpis/assignment', $data);
    }

    public function update($data, $id)
    {
        return $this->performRequest('PUT', '/mpis/assignment/'.$id, $data);
    }

    public function delete($id)
    {
        return $this->performRequest('DELETE', '/mpis/assignment/'.$id);
    }

    public function onlyTrashed($data)
    {
        return $this->performRequest('GET', '/mpis/assignment/only-trashed', $data);
    }

    public function restore($id)
    {
        return $this->performRequest('PUT', '/mpis/assignment/restore/'.$id);
    }

    public function forceDelete($id)
    {
        return $this->performRequest('DELETE', '/mpis/assignment/force-delete/'.$id);
    }

    public function getAssignmentById($id)
    {
        return $this->performRequest('GET', '/mpis/show-assignment/'. $id);
    }
}