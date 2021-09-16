<?php

namespace App\Services\ApiService\v1\CmisService\References;

use App\Traits\ConsumeExternalService;

class Qrs
{
    use ConsumeExternalService;

    public $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.cmis_base_uri');
    }

    public function index($data)
    {
        return $this->performRequest('GET', '/cmis/qrs', $data);
    }

    public function store($data)
    {
        return $this->performRequest('POST', '/cmis/qrs', $data);
    }

    public function update($data, $id)
    {
        return $this->performRequest('PUT', '/cmis/qrs/'.$id, $data);
    }

    public function delete($id)
    {
        return $this->performRequest('DELETE', '/cmis/qrs/'.$id);
    }

    public function onlyTrashed($data)
    {
        return $this->performRequest('GET', '/cmis/qrs/only-trashed', $data);
    }

    public function restore($id)
    {
        return $this->performRequest('PUT', '/cmis/qrs/restore/'.$id);
    }

    public function forceDelete($id)
    {
        return $this->performRequest('DELETE', '/cmis/qrs/force-delete/'.$id);
    }

    public function searchQrs($data)
    {
        return $this->performRequest('GET', '/cmis/search', $data);
    }

    public function searchQrsByName($data)
    {
        return $this->performRequest('GET', '/cmis/search/qrs-name', $data);
    }

    public function searchQrsByNameOnly($data)
    {
        return $this->performRequest('GET', '/cmis/search/qrs/name-only', $data);
    }
}