<?php

namespace App\Services\ApiServices\v1\MpisService\Transactions;

use App\Traits\ConsumeExternalService;

class Personnel
{
    use ConsumeExternalService;

    public $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.mpis_base_uri');
    }

    public function index($data)
    {
        return $this->performRequest('GET', '/api/v1/mpis/personnels', $data);
    }

    public function store($data)
    {
        return $this->performRequest('POST', '/api/v1/mpis/personnels', $data);
    }

    public function update($data, $id)
    {
        return $this->performRequest('PUT', '/api/v1/mpis/personnels/'.$id, $data);
    }

    public function delete($id)
    {
        return $this->performRequest('DELETE', '/api/v1/mpis/personnels/'.$id);
    }

    public function onlyTrashed($data)
    {
        return $this->performRequest('GET', '/api/v1/mpis/personnels/only-trashed', $data);
    }

    public function restore($id)
    {
        return $this->performRequest('PUT', '/api/v1/mpis/personnels/restore/'.$id);
    }

    public function forceDelete($id)
    {
        return $this->performRequest('DELETE', '/api/v1/mpis/personnels/force-delete/'.$id);
    }

    public function profiles()
    {
        return $this->performRequest('GET', '/api/v1/mpis/personnels/profiles');
    }

    public function addProfile($data)
    {
        return $this->performRequest('POST', '/api/v1/mpis/personnels/profiles/add', $data);
    }
}