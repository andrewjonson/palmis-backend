<?php

namespace App\Services\ApiService\v1\SumisService\References;

use App\Traits\ConsumeExternalService;

class IssuanceDirectivePurpose
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
        return $this->performRequest('GET', '/sumis/issuance-directive-purpose', $data);
    }

    public function store($data)
    {
        return $this->performRequest('POST', '/sumis/issuance-directive-purpose', $data);
    }

    public function update($data, $id)
    {
        return $this->performRequest('PUT', '/sumis/issuance-directive-purpose/'.$id, $data);
    }

    public function delete($id)
    {
        return $this->performRequest('DELETE', '/sumis/issuance-directive-purpose/'.$id);
    }

    public function onlyTrashed($data)
    {
        return $this->performRequest('GET', '/sumis/issuance-directive-purpose/only-trashed', $data);
    }

    public function restore($id)
    {
        return $this->performRequest('PUT', '/sumis/issuance-directive-purpose/restore/'.$id);
    }

    public function forceDelete($id)
    {
        return $this->performRequest('DELETE', '/sumis/issuance-directive-purpose/force-delete/'.$id);
    }
}