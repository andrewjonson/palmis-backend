<?php

namespace App\Services\ApiService\v1\MpisService\References;

use App\Traits\ConsumeExternalService;

class Citizenship
{
    use ConsumeExternalService;

    public $baseUrl;
    public $secret;

    public function __construct()
    {
        $this->baseUrl = config('services.mpis.base_url');
        $this->secret = config('services.mpis.secret');
    }

    public function index($data)
    {
        return $this->performRequest('GET', '/mpis/citizenship', $data);
    }

    public function store($data)
    {
        return $this->performRequest('POST', '/mpis/citizenship', $data);
    }

    public function update($data, $id)
    {
        return $this->performRequest('PUT', '/mpis/citizenship/'.$id, $data);
    }

    public function delete($id)
    {
        return $this->performRequest('DELETE', '/mpis/citizenship/'.$id);
    }

    public function onlyTrashed($data)
    {
        return $this->performRequest('GET', '/mpis/citizenship/only-trashed', $data);
    }

    public function restore($id)
    {
        return $this->performRequest('PUT', '/mpis/citizenship/restore/'.$id);
    }

    public function forceDelete($id)
    {
        return $this->performRequest('DELETE', '/mpis/citizenship/force-delete/'.$id);
    }

    public function searchCitizenship($data)
    {
        return $this->performRequest('GET', '/mpis/citizenship-search', $data);
    }
}