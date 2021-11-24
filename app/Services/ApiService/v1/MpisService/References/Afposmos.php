<?php

namespace App\Services\ApiService\v1\MpisService\References;

use App\Traits\ConsumeExternalService;

class Afposmos
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
        return $this->performRequest('GET', '/mpis/afposmos', $data);
    }

    public function store($data)
    {
        return $this->performRequest('POST', '/mpis/afposmos', $data);
    }

    public function update($data, $id)
    {
        return $this->performRequest('PUT', '/mpis/afposmos/'.$id, $data);
    }

    public function delete($id)
    {
        return $this->performRequest('DELETE', '/mpis/afposmos/'.$id);
    }

    public function onlyTrashed($data)
    {
        return $this->performRequest('GET', '/mpis/afposmos/only-trashed', $data);
    }

    public function restore($id)
    {
        return $this->performRequest('PUT', '/mpis/afposmos/restore/'.$id);
    }

    public function forceDelete($id)
    {
        return $this->performRequest('DELETE', '/mpis/afposmos/force-delete/'.$id);
    }

    public function getAfposmosById($id)
    {
        return $this->performRequest('GET', '/mpis/show-afposmos/'. $id);
    }
}