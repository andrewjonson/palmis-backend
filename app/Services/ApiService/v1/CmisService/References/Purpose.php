<?php

namespace App\Services\ApiService\v1\CmisService\References;

use App\Traits\ConsumeExternalService;

class Purpose
{
    use ConsumeExternalService;

    public $baseUrl;
    public $secret;

    public function __construct()
    {
        $this->baseUrl = config('services.cmis.base_url');
        $this->secret = config('services.cmis.secret');
    }

    public function index($data)
    {
        return $this->performRequest('GET', '/cmis/purpose', $data);
    }

    public function store($data)
    {
        return $this->performRequest('POST', '/cmis/purpose', $data);
    }

    public function update($data, $id)
    {
        return $this->performRequest('PUT', '/cmis/purpose/'.$id, $data);
    }

    public function delete($id)
    {
        return $this->performRequest('DELETE', '/cmis/purpose/'.$id);
    }

    public function onlyTrashed($data)
    {
        return $this->performRequest('GET', '/cmis/purpose/only-trashed', $data);
    }

    public function restore($id)
    {
        return $this->performRequest('PUT', '/cmis/purpose/restore/'.$id);
    }

    public function forceDelete($id)
    {
        return $this->performRequest('DELETE', '/cmis/purpose/force-delete/'.$id);
    }
}