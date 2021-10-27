<?php

namespace App\Services\ApiService\v1\ToeisService\References;

use App\Traits\ConsumeExternalService;

class Assignment
{
    use ConsumeExternalService;

    public $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.toeis_base_uri');
    }

    public function index($data)
    {
        return $this->performRequest('GET', '/toeis/assignments', $data);
    }

    public function store($data)
    {
        return $this->performRequest('POST', '/toeis/assignments', $data);
    }

    public function update($data, $id)
    {
        return $this->performRequest('PUT', '/toeis/assignments/'.$id, $data);
    }

    public function delete($id)
    {
        return $this->performRequest('DELETE', '/toeis/assignments/'.$id);
    }

    public function onlyTrashed($data)
    {
        return $this->performRequest('GET', '/toeis/assignments/only-trashed', $data);
    }

    public function restore($id)
    {
        return $this->performRequest('PUT', '/toeis/assignments/restore/'.$id);
    }

    public function forceDelete($id)
    {
        return $this->performRequest('DELETE', '/toeis/assignments/force-delete/'.$id);
    }
}