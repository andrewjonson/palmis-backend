<?php

namespace App\Services\ApiService\v1\OrderPubService\References;

use App\Traits\ConsumeExternalService;

class AuthorityLine
{
    use ConsumeExternalService;

    public $baseUrl;
    public $secret;

    public function __construct()
    {
        $this->baseUrl = config('services.orderpub.base_url');
        $this->secret = config('services.orderpub.secret');
    }

    public function index($data)
    {
        return $this->performRequest('GET', '/orderpub/authoritylines', $data);
    }

    public function store($data)
    {
        return $this->performRequest('POST', '/orderpub/authoritylines', $data);
    }

    public function update($data, $id)
    {
        return $this->performRequest('PUT', '/orderpub/authoritylines/'.$id, $data);
    }

    public function delete($id)
    {
        return $this->performRequest('DELETE', '/orderpub/authoritylines/'.$id);
    }

    public function onlyTrashed($data)
    {
        return $this->performRequest('GET', '/orderpub/authoritylines/only-trashed', $data);
    }

    public function restore($id)
    {
        return $this->performRequest('PUT', '/orderpub/authoritylines/restore/'.$id);
    }

    public function forceDelete($id)
    {
        return $this->performRequest('DELETE', '/orderpub/authoritylines/force-delete/'.$id);
    }

    public function getAuthorityLine($office)
    {
        return $this->performRequest('GET', '/orderpub/authority/'.$office);
    }
}