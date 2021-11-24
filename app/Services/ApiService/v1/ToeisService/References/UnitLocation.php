<?php

namespace App\Services\ApiService\v1\ToeisService\References;

use App\Traits\ConsumeExternalService;

class UnitLocation
{
    use ConsumeExternalService;

    public $baseUrl;
    public $secret;

    public function __construct()
    {
        $this->baseUrl = config('services.toeis.base_url');
        $this->secret = config('services.toeis.secret');
    }

    public function index($data)
    {
        return $this->performRequest('GET', '/toeis/unit-locations', $data);
    }

    public function store($data)
    {
        return $this->performRequest('POST', '/toeis/unit-locations', $data);
    }

    public function update($data, $id)
    {
        return $this->performRequest('PUT', '/toeis/unit-locations/'.$id, $data);
    }

    public function delete($id)
    {
        return $this->performRequest('DELETE', '/toeis/unit-locations/'.$id);
    }

    public function onlyTrashed($data)
    {
        return $this->performRequest('GET', '/toeis/unit-locations/only-trashed', $data);
    }

    public function restore($id)
    {
        return $this->performRequest('PUT', '/toeis/unit-locations/restore/'.$id);
    }

    public function forceDelete($id)
    {
        return $this->performRequest('DELETE', '/toeis/unit-locations/force-delete/'.$id);
    }
}