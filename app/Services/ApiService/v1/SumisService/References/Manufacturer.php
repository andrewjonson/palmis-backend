<?php

namespace App\Services\ApiService\v1\SumisService\References;

use App\Traits\ConsumeExternalService;

class Manufacturer
{
    use ConsumeExternalService;

    public $baseUrl;
    public $secret;

    public function __construct()
    {
        $this->baseUrl = config('services.sumis.base_url');
        $this->secret = config('services.sumis.secret');
    }

    public function index($data)
    {
        return $this->performRequest('GET', '/sumis/manufacturer', $data);
    }

    public function store($data)
    {
        return $this->performRequest('POST', '/sumis/manufacturer', $data);
    }

    public function update($data, $id)
    {
        return $this->performRequest('PUT', '/sumis/manufacturer/'.$id, $data);
    }

    public function delete($id)
    {
        return $this->performRequest('DELETE', '/sumis/manufacturer/'.$id);
    }

    public function onlyTrashed($data)
    {
        return $this->performRequest('GET', '/sumis/manufacturer/only-trashed', $data);
    }

    public function restore($id)
    {
        return $this->performRequest('PUT', '/sumis/manufacturer/restore/'.$id);
    }

    public function forceDelete($id)
    {
        return $this->performRequest('DELETE', '/sumis/manufacturer/force-delete/'.$id);
    }
}