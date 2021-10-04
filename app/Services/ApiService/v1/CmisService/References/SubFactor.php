<?php

namespace App\Services\ApiService\v1\CmisService\References;

use App\Traits\ConsumeExternalService;

class SubFactor
{
    use ConsumeExternalService;

    public $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.cmis_base_uri');
    }

    public function index($data)
    {
        return $this->performRequest('GET', '/cmis/subfactor/name', $data);
    }

    public function store($data)
    {
        return $this->performRequest('POST', '/cmis/subfactor/name', $data);
    }

    public function update($data, $id)
    {
        return $this->performRequest('PUT', '/cmis/subfactor/name/'.$id, $data);
    }

    public function delete($id)
    {
        return $this->performRequest('DELETE', '/cmis/subfactor/name/'.$id);
    }

    public function onlyTrashed($data)
    {
        return $this->performRequest('GET', '/cmis/subfactor/name/only-trashed', $data);
    }

    public function restore($id)
    {
        return $this->performRequest('PUT', '/cmis/subfactor/name/restore/'.$id);
    }

    public function forceDelete($id)
    {
        return $this->performRequest('DELETE', '/cmis/subfactor/name/force-delete/'.$id);
    }

    public function searchSubfactorByCriteriaAndQrs($data)
    {
        return $this->performRequest('GET', '/cmis/search/criteria',$data);
    }

    public function getDataByCriteria($data)
    {
        return $this->performRequest('GET', '/cmis/search/sublvl/dropdown',$data);
    }

    public function getPointsByCriteriaAndQrs($data)
    {
        return $this->performRequest('GET', '/cmis/search/points',$data);
    }
}