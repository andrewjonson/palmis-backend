<?php

namespace App\Services\ApiService\v1\CmisService\References;

use App\Traits\ConsumeExternalService;

class SubFactorLevelOne
{
    use ConsumeExternalService;

    public $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.cmis_base_uri');
    }

    public function index($data)
    {
        return $this->performRequest('GET', '/cmis/sublvl1/name', $data);
    }

    public function store($data)
    {
        return $this->performRequest('POST', '/cmis/sublvl1/name', $data);
    }

    public function update($data, $id)
    {
        return $this->performRequest('PUT', '/cmis/sublvl1/name/'.$id, $data);
    }

    public function delete($id)
    {
        return $this->performRequest('DELETE', '/cmis/sublvl1/name/'.$id);
    }

    public function onlyTrashed($data)
    {
        return $this->performRequest('GET', '/cmis/sublvl1/name/only-trashed', $data);
    }

    public function restore($id)
    {
        return $this->performRequest('PUT', '/cmis/sublvl1/restore/name/'.$id);
    }

    public function forceDelete($id)
    {
        return $this->performRequest('DELETE', '/cmis/sublvl1/name/force-delete/'.$id);
    }

    public function searchSubLevelByParent($data)
    {
        return $this->performRequest('GET', '/cmis/search/main-subfactor', $data);
    }

    public function searchSubLevelPoints($data)
    {
        return $this->performRequest('GET', '/cmis/search/sublvl/points', $data);
    }
}