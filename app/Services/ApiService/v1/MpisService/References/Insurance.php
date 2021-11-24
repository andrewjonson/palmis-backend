<?php

namespace App\Services\ApiService\v1\MpisService\References;

use App\Traits\ConsumeExternalService;

class Insurance
{
    use ConsumeExternalService;

    public $baseUrl;
    public $secret;

    public function __construct()
    {
        $this->baseUrl = config('services.mpis.base_url');
        $this->secret = config('services.mpis.secret');
    }

    public function index($data)
    {
        return $this->performRequest('GET', '/mpis/insurance', $data);
    }

    public function store($data)
    {
        return $this->performRequest('POST', '/mpis/insurance', $data);
    }

    public function update($data, $id)
    {
        return $this->performRequest('PUT', '/mpis/insurance/'.$id, $data);
    }

    public function delete($id)
    {
        return $this->performRequest('DELETE', '/mpis/insurance/'.$id);
    }

    public function onlyTrashed($data)
    {
        return $this->performRequest('GET', '/mpis/insurance/only-trashed', $data);
    }

    public function restore($id)
    {
        return $this->performRequest('PUT', '/mpis/insurance/restore/'.$id);
    }

    public function forceDelete($id)
    {
        return $this->performRequest('DELETE', '/mpis/insurance/force-delete/'.$id);
    }
}