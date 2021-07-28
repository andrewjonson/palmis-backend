<?php

namespace App\Services\ApiService\v1\OrderPubService\References;

use App\Traits\ConsumeExternalService;

class Template
{
    use ConsumeExternalService;

    public $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.orderpub_base_uri');
    }

    public function index($data)
    {
        return $this->performRequest('GET', '/api/v1/orderpub/templates', $data);
    }

    public function store($data)
    {
        return $this->performRequest('POST', '/api/v1/orderpub/templates', $data);
    }

    public function update($data, $id)
    {
        return $this->performRequest('PUT', '/api/v1/orderpub/templates/'.$id, $data);
    }

    public function delete($id)
    {
        return $this->performRequest('DELETE', '/api/v1/orderpub/templates/'.$id);
    }

    public function onlyTrashed($data)
    {
        return $this->performRequest('GET', '/api/v1/orderpub/templates/only-trashed', $data);
    }

    public function restore($id)
    {
        return $this->performRequest('PUT', '/api/v1/orderpub/templates/restore/'.$id);
    }

    public function forceDelete($id)
    {
        return $this->performRequest('DELETE', '/api/v1/orderpub/templates/force-delete/'.$id);
    }
}