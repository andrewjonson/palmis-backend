<?php

namespace App\Services\ApiService\v1\CmisService\References;

use App\Traits\ConsumeExternalService;

class Appurtenance
{
    use ConsumeExternalService;

    public $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.cmis_base_uri');
    }

    public function index($data)
    {
        return $this->performRequest('GET', '/cmis/appurtenance', $data);
    }

    public function store($data)
    {
        return $this->performRequest('POST', '/cmis/appurtenance', $data);
    }

    public function update($data, $id)
    {
        return $this->performRequest('PUT', '/cmis/appurtenance/'.$id, $data);
    }

    public function delete($id)
    {
        return $this->performRequest('DELETE', '/cmis/appurtenance/'.$id);
    }

    public function onlyTrashed($data)
    {
        return $this->performRequest('GET', '/cmis/appurtenance/only-trashed', $data);
    }

    public function restore($id)
    {
        return $this->performRequest('PUT', '/cmis/appurtenance/restore/'.$id);
    }

    public function forceDelete($id)
    {
        return $this->performRequest('DELETE', '/cmis/appurtenance/force-delete/'.$id);
    }

    public function getAppurtenances($data)
    {
        return $this->performRequest('GET', '/cmis/search-appurtenances', $data);
    }

}