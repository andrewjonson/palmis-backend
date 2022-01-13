<?php

namespace App\Services\ApiService\v1\SumisService\References;

use App\Traits\ConsumeExternalService;

class ServicingFpao
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
        return $this->performRequest('GET', '/sumis/servicing-fpao', $data);
    }

    public function store($data)
    {
        return $this->performRequest('POST', '/sumis/servicing-fpao', $data);
    }

    public function update($data, $id)
    {
        return $this->performRequest('PUT', '/sumis/servicing-fpao/'.$id, $data);
    }

    public function delete($id)
    {
        return $this->performRequest('DELETE', '/sumis/servicing-fpao/'.$id);
    }

    public function onlyTrashed($data)
    {
        return $this->performRequest('GET', '/sumis/servicing-fpao/only-trashed', $data);
    }

    public function restore($id)
    {
        return $this->performRequest('PUT', '/sumis/servicing-fpao/restore/'.$id);
    }

    public function forceDelete($id)
    {
        return $this->performRequest('DELETE', '/sumis/servicing-fpao/force-delete/'.$id);
    }
}