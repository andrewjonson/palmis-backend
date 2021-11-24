<?php

namespace App\Services\ApiService\v1\ToeisService\References;

use App\Traits\ConsumeExternalService;

class Echelon
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
        return $this->performRequest('GET', '/toeis/echelons', $data);
    }

    public function store($data)
    {
        return $this->performRequest('POST', '/toeis/echelons', $data);
    }

    public function update($data, $id)
    {
        return $this->performRequest('PUT', '/toeis/echelons/'.$id, $data);
    }

    public function delete($id)
    {
        return $this->performRequest('DELETE', '/toeis/echelons/'.$id);
    }

    public function onlyTrashed($data)
    {
        return $this->performRequest('GET', '/toeis/echelons/only-trashed', $data);
    }

    public function restore($id)
    {
        return $this->performRequest('PUT', '/toeis/echelons/restore/'.$id);
    }

    public function forceDelete($id)
    {
        return $this->performRequest('DELETE', '/toeis/echelons/force-delete/'.$id);
    }
}