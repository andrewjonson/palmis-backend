<?php

namespace App\Services\ApiService\v1\MpisService\References;

use App\Traits\ConsumeExternalService;

class Signatory
{
    use ConsumeExternalService;

    public $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.mpis_base_uri');
    }

    public function index($data)
    {
        return $this->performRequest('GET', '/mpis/signatory', $data);
    }

    public function store($data)
    {
        return $this->performRequest('POST', '/mpis/signatory', $data);
    }

    public function update($data, $id)
    {
        return $this->performRequest('PUT', '/mpis/signatory/'.$id, $data);
    }

    public function delete($id)
    {
        return $this->performRequest('DELETE', '/mpis/signatory/'.$id);
    }

    public function onlyTrashed($data)
    {
        return $this->performRequest('GET', '/mpis/signatory/only-trashed', $data);
    }

    public function restore($id)
    {
        return $this->performRequest('PUT', '/mpis/signatory/restore/'.$id);
    }

    public function forceDelete($id)
    {
        return $this->performRequest('DELETE', '/mpis/signatory/force-delete/'.$id);
    }
}