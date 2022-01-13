<?php

namespace App\Services\ApiService\v1\SumisService\References;

use App\Traits\ConsumeExternalService;

class AmmunitionClassification
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
        return $this->performRequest('GET', '/sumis/ammunition/classification', $data);
    }

    public function store($data)
    {
        return $this->performRequest('POST', '/sumis/ammunition/classification', $data);
    }

    public function update($data, $id)
    {
        return $this->performRequest('PUT', '/sumis/ammunition/classification/'.$id, $data);
    }

    public function delete($id)
    {
        return $this->performRequest('DELETE', '/sumis/ammunition/classification/'.$id);
    }

    public function onlyTrashed($data)
    {
        return $this->performRequest('GET', '/sumis/ammunition/classification/only-trashed', $data);
    }

    public function restore($id)
    {
        return $this->performRequest('PUT', '/sumis/ammunition/classification/restore/'.$id);
    }

    public function forceDelete($id)
    {
        return $this->performRequest('DELETE', '/sumis/ammunition/classification/force-delete/'.$id);
    }
}