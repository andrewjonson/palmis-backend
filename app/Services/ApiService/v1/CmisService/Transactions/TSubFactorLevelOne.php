<?php

namespace App\Services\ApiService\v1\CmisService\Transactions;

use App\Traits\ConsumeExternalService;

class TSubFactorLevelOne
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
        return $this->performRequest('GET', '/cmis/sublvl1', $data);
    }

    public function store($data)
    {
        return $this->performRequest('POST', '/cmis/sublvl1', $data);
    }

    public function update($data, $id)
    {
        return $this->performRequest('PUT', '/cmis/sublvl1/'.$id, $data);
    }

    public function delete($id)
    {
        return $this->performRequest('DELETE', '/cmis/sublvl1/'.$id);
    }

    public function onlyTrashed($data)
    {
        return $this->performRequest('GET', '/cmis/sublvl1/only-trashed', $data);
    }

    public function restore($id)
    {
        return $this->performRequest('PUT', '/cmis/sublvl1/restore/'.$id);
    }

    public function forceDelete($id)
    {
        return $this->performRequest('DELETE', '/cmis/sublvl1/force-delete/'.$id);
    }
}