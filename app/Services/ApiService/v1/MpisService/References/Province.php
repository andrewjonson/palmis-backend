<?php

namespace App\Services\ApiService\v1\MpisService\References;

use App\Traits\ConsumeExternalService;

class Province
{
    use ConsumeExternalService;

    public $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.mpis_base_uri');
    }

    public function index($data)
    {
        return $this->performRequest('GET', '/mpis/province', $data);
    }

    public function store($data)
    {
        return $this->performRequest('POST', '/mpis/province', $data);
    }

    public function update($data, $id)
    {
        return $this->performRequest('PUT', '/mpis/province/'.$id, $data);
    }

    public function delete($id)
    {
        return $this->performRequest('DELETE', '/mpis/province/'.$id);
    }

    public function onlyTrashed($data)
    {
        return $this->performRequest('GET', '/mpis/province/only-trashed', $data);
    }

    public function restore($id)
    {
        return $this->performRequest('PUT', '/mpis/province/restore/'.$id);
    }

    public function forceDelete($id)
    {
        return $this->performRequest('DELETE', '/mpis/province/force-delete/'.$id);
    }

    public function getProvince($data)
    {
        return $this->performRequest('GET', '/mpis/get-province', $data);
    }

    public function getProvinceById($id)
    {
        return $this->performRequest('GET', '/mpis/show-province/'.$id);
    }
}