<?php

namespace App\Services\ApiService\v1\CmisService\References;

use App\Traits\ConsumeExternalService;

class Criteria
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
        return $this->performRequest('GET', '/cmis/criteria', $data);
    }

    public function store($data)
    {
        return $this->performRequest('POST', '/cmis/criteria', $data);
    }

    public function update($data, $id)
    {
        return $this->performRequest('PUT', '/cmis/criteria/'.$id, $data);
    }

    public function delete($id)
    {
        return $this->performRequest('DELETE', '/cmis/criteria/'.$id);
    }

    public function onlyTrashed($data)
    {
        return $this->performRequest('GET', '/cmis/criteria/only-trashed', $data);
    }

    public function restore($id)
    {
        return $this->performRequest('PUT', '/cmis/criteria/restore/'.$id);
    }

    public function forceDelete($id)
    {
        return $this->performRequest('DELETE', '/cmis/criteria/force-delete/'.$id);
    }

    public function getCriteriaPoints($data)
    {
        return $this->performRequest('GET', '/cmis/get/criteria/points', $data);
    }
}