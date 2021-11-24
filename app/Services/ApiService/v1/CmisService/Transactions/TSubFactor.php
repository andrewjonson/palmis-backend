<?php

namespace App\Services\ApiService\v1\CmisService\Transactions;

use App\Traits\ConsumeExternalService;

class TSubFactor
{
    use ConsumeExternalService;

    public $baseUrl;
    public $secret;

    public function __construct()
    {
        $this->baseUrl = config('services.cmis.base_url');
        $this->secret = config('services.cmis.secret');
    }

    public function index($data)
    {
        return $this->performRequest('GET', '/cmis/subfactor', $data);
    }

    public function store($data)
    {
        return $this->performRequest('POST', '/cmis/subfactor', $data);
    }

    public function update($data, $id)
    {
        return $this->performRequest('PUT', '/cmis/subfactor/'.$id, $data);
    }

    public function delete($id)
    {
        return $this->performRequest('DELETE', '/cmis/subfactor/'.$id);
    }

    public function onlyTrashed($data)
    {
        return $this->performRequest('GET', '/cmis/subfactor/only-trashed', $data);
    }

    public function restore($id)
    {
        return $this->performRequest('PUT', '/cmis/subfactor/restore/'.$id);
    }

    public function forceDelete($id)
    {
        return $this->performRequest('DELETE', '/cmis/subfactor/force-delete/'.$id);
    }

    public function searchPoints($data)
    {
        return $this->performRequest('GET', '/cmis/search/points', $data);
    }

    public function searchByCriteria($data)
    {
        return $this->performRequest('GET', '/cmis/search/criteria', $data);
    }

    public function getDataByCriteria($data)
    {
        return $this->performRequest('GET', '/cmis/search/sublvl/dropdown', $data);
    }

}