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

    public function searchPersonnel($data)
    {
        return $this->performRequest('POST', '/mpis/personnel-search', $data);
    }

    public function getPersonnelById($id)
    {
        return $this->performRequest('GET', '/mpis/personnels/show-personnel/'.$id);
    }

    public function advanceSearchPersonnel($data)
    {
        return $this->performRequest('POST', '/mpis/search-info', $data);
    }

    public function getPersonnelByPmcode($pmcode)
    {
        return $this->performRequest('GET', '/mpis/show-pmcode/'.$pmcode);
    }

    public function uploadPersonnelImage($data)
    {
        return $this->performRequest('POST', '/mpis/upload-image', $data);
    }

    public function searchPersonnelBySerialNumberBirthdate($data)
    {
        return $this->performRequest('POST', '/mpis/search-serial-birth', $data);
    }

    public function searchPersonnelBySerial($serial)
    {
        return $this->performRequest('POST', '/mpis/search-serial', $serial);
    }

    public function createPersonnel($serial)
    {
        return $this->performRequest('POST', '/mpis/create-personnel', $serial);
    }


}