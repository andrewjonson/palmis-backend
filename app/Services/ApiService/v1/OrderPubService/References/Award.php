<?php

namespace App\Services\ApiService\v1\OrderPubService\References;

use App\Traits\ConsumeExternalService;

class Award
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
        return $this->performRequest('GET', '/orderpub/awards', $data);
    }

    public function store($data)
    {
        return $this->performRequest('POST', '/orderpub/awards', $data);
    }

    public function update($data, $id)
    {
        return $this->performRequest('PUT', '/orderpub/awards/'.$id, $data);
    }

    public function delete($id)
    {
        return $this->performRequest('DELETE', '/orderpub/awards/'.$id);
    }

    public function onlyTrashed($data)
    {
        return $this->performRequest('GET', '/orderpub/awards/only-trashed', $data);
    }

    public function restore($id)
    {
        return $this->performRequest('PUT', '/orderpub/awards/restore/'.$id);
    }

    public function forceDelete($id)
    {
        return $this->performRequest('DELETE', '/orderpub/awards/force-delete/'.$id);
    }
}