<?php

namespace App\Services\ApiService\v1\SumisService\References;

use App\Traits\ConsumeExternalService;

class IssuanceDirectiveCondition
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
        return $this->performRequest('GET', '/sumis/issuance-directive-condition', $data);
    }

    public function store($data)
    {
        return $this->performRequest('POST', '/sumis/issuance-directive-condition', $data);
    }

    public function update($data, $id)
    {
        return $this->performRequest('PUT', '/sumis/issuance-directive-condition/'.$id, $data);
    }

    public function delete($id)
    {
        return $this->performRequest('DELETE', '/sumis/issuance-directive-condition/'.$id);
    }

    public function onlyTrashed($data)
    {
        return $this->performRequest('GET', '/sumis/issuance-directive-condition/only-trashed', $data);
    }

    public function restore($id)
    {
        return $this->performRequest('PUT', '/sumis/issuance-directive-condition/restore/'.$id);
    }

    public function forceDelete($id)
    {
        return $this->performRequest('DELETE', '/sumis/issuance-directive-condition/force-delete/'.$id);
    }
}