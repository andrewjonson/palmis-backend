<?php

namespace App\Services\ApiService\v1\SumisService\References;

use App\Traits\ConsumeExternalService;

class Region
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
        return $this->performRequest('GET', '/sumis/region', $data);
    }

    public function store($data)
    {
        return $this->performRequest('POST', '/sumis/region', $data);
    }

    public function update($data, $id)
    {
        return $this->performRequest('PUT', '/sumis/region/'.$id, $data);
    }

    public function delete($id)
    {
        return $this->performRequest('DELETE', '/sumis/region/'.$id);
    }

    public function onlyTrashed($data)
    {
        return $this->performRequest('GET', '/sumis/region/only-trashed', $data);
    }

    public function restore($id)
    {
        return $this->performRequest('PUT', '/sumis/region/restore/'.$id);
    }

    public function forceDelete($id)
    {
        return $this->performRequest('DELETE', '/sumis/region/force-delete/'.$id);
    }
}