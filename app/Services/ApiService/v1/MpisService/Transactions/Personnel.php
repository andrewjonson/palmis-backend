<?php

namespace App\Services\ApiService\v1\MpisService\Transactions;

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
        return $this->performRequest('GET', '/mpis/personnels', $data);
    }

    public function store($data)
    {
        return $this->performRequest('POST', '/mpis/personnels', $data);
    }

    public function update($data, $id)
    {
        return $this->performRequest('PUT', '/mpis/personnels/'.$id, $data);
    }

    public function delete($id)
    {
        return $this->performRequest('DELETE', '/mpis/personnels/'.$id);
    }

    public function onlyTrashed($data)
    {
        return $this->performRequest('GET', '/mpis/personnels/only-trashed', $data);
    }

    public function restore($id)
    {
        return $this->performRequest('PUT', '/mpis/personnels/restore/'.$id);
    }

    public function forceDelete($id)
    {
        return $this->performRequest('DELETE', '/mpis/personnels/force-delete/'.$id);
    }
}