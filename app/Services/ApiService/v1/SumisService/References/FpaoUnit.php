<?php

namespace App\Services\ApiService\v1\SumisService\References;

use App\Traits\ConsumeExternalService;

class FpaoUnit
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
        return $this->performRequest('GET', '/sumis/fpao-unit', $data);
    }

    public function store($data)
    {
        return $this->performRequest('POST', '/sumis/fpao-unit', $data);
    }

    public function update($data, $id)
    {
        return $this->performRequest('PUT', '/sumis/fpao-unit/'.$id, $data);
    }

    public function delete($id)
    {
        return $this->performRequest('DELETE', '/sumis/fpao-unit/'.$id);
    }

    public function onlyTrashed($data)
    {
        return $this->performRequest('GET', '/sumis/fpao-unit/only-trashed', $data);
    }

    public function restore($id)
    {
        return $this->performRequest('PUT', '/sumis/fpao-unit/restore/'.$id);
    }

    public function forceDelete($id)
    {
        return $this->performRequest('DELETE', '/sumis/fpao-unit/force-delete/'.$id);
    }

    public function filterUnit($id)
    {
        return $this->performRequest('GET', '/sumis/fpaounit/get-unit/'.$id);
    }
}