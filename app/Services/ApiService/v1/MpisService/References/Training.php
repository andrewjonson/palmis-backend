<?php

namespace App\Services\ApiService\v1\MpisService\References;

use App\Traits\ConsumeExternalService;

class Training
{
    use ConsumeExternalService;

    public $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.mpis_base_uri');
    }

    public function index($data)
    {
        return $this->performRequest('GET', '/mpis/training', $data);
    }

    public function store($data)
    {
        return $this->performRequest('POST', '/mpis/training', $data);
    }

    public function update($data, $id)
    {
        return $this->performRequest('PUT', '/mpis/training/'.$id, $data);
    }

    public function delete($id)
    {
        return $this->performRequest('DELETE', '/mpis/training/'.$id);
    }

    public function onlyTrashed($data)
    {
        return $this->performRequest('GET', '/mpis/training/only-trashed', $data);
    }

    public function restore($id)
    {
        return $this->performRequest('PUT', '/mpis/training/restore/'.$id);
    }

    public function forceDelete($id)
    {
        return $this->performRequest('DELETE', '/mpis/training/force-delete/'.$id);
    }

    public function getTrainingById($id)
    {
        return $this->performRequest('GET', '/mpis/show-training/'.$id);
    }
}