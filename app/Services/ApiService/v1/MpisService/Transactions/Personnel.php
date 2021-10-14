<?php

namespace App\Services\ApiService\v1\MpisService\Transactions;

use Illuminate\Support\Facades\Http;
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
        return $this->performRequest('GET', '/mpis/show-personnel/'.$id);
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

    public function searchPersonnelBySerial($serial)
    {
        return $this->performRequest('POST', '/mpis/search-serial', $serial);
    }

    public function createPersonnel($serial)
    {
        return $this->performRequest('POST', '/mpis/create-personnel', $serial);
    }

    public function createPersonnelRank($data)
    {
        return $this->performRequest('POST', '/mpis/create-personnel-rank', $data);
    }

    public function createPersonnelUnit($data)
    {
        return $this->performRequest('POST', '/mpis/create-personnel-unit', $data);
    }

    public function createPersonnelAddress($data)
    {
        return $this->performRequest('POST', '/mpis/store-address', $data);
    }

    public function getPersonnelAddress($id)
    {
        return $this->performRequest('GET', '/mpis/show-address/'.$id);
    }

    public function updatePersonnelAddress($data, $id)
    {
        return $this->performRequest('PUT', '/mpis/update-address/'.$id, $data);
    }

    public function countPersonnel()
    {
        return $this->performRequest('GET', '/mpis/personnel-total');
    }

    public function updatePersonnel($data, $id)
    {
        return $this->performRequest('PUT', '/mpis/update-personnel/'.$id, $data);
    }

    public function createPersonnelPromotion($data)
    {
        return $this->performRequest('POST', '/mpis/store-personnel-promotion', $data);
    }

    public function dynamicSearchPersonnel($data)
    {
        return $this->performRequest('POST', '/mpis/personnel-dynamic-search', $data);
    }
}