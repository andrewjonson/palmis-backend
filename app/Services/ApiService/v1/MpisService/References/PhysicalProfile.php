<?php

namespace App\Services\ApiService\v1\MpisService\References;

use App\Traits\ConsumeExternalService;

class PhysicalProfile
{
    use ConsumeExternalService;

    public $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.mpis_base_uri');
    }

    public function index($data)
    {
        return $this->performRequest('GET', '/mpis/physical-profile', $data);
    }

    public function store($data)
    {
        return $this->performRequest('POST', '/mpis/physical-profile', $data);
    }

    public function update($data, $id)
    {
        return $this->performRequest('PUT', '/mpis/physical-profile/'.$id, $data);
    }

    public function delete($id)
    {
        return $this->performRequest('DELETE', '/mpis/physical-profile/'.$id);
    }

    public function onlyTrashed($data)
    {
        return $this->performRequest('GET', '/mpis/physical-profile/only-trashed', $data);
    }

    public function restore($id)
    {
        return $this->performRequest('PUT', '/mpis/physical-profile/restore/'.$id);
    }

    public function forceDelete($id)
    {
        return $this->performRequest('DELETE', '/mpis/physical-profile/force-delete/'.$id);
    }
}