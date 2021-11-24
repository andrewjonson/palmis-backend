<?php

namespace App\Services\ApiService\v1\OrderPubService\References;

use App\Traits\ConsumeExternalService;

class Appurtenance
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
        return $this->performRequest('GET', '/orderpub/appurtenances', $data);
    }

    public function store($data)
    {
        return $this->performRequest('POST', '/orderpub/appurtenances', $data);
    }

    public function update($data, $id)
    {
        return $this->performRequest('PUT', '/orderpub/appurtenances/'.$id, $data);
    }

    public function delete($id)
    {
        return $this->performRequest('DELETE', '/orderpub/appurtenances/'.$id);
    }

    public function onlyTrashed($data)
    {
        return $this->performRequest('GET', '/orderpub/appurtenances/only-trashed', $data);
    }

    public function restore($id)
    {
        return $this->performRequest('PUT', '/orderpub/appurtenances/restore/'.$id);
    }

    public function forceDelete($id)
    {
        return $this->performRequest('DELETE', '/orderpub/appurtenances/force-delete/'.$id);
    }
}