<?php

namespace App\Services\ApiService\v1\CmisService\References;

use App\Traits\ConsumeExternalService;

class Award
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
        return $this->performRequest('GET', '/cmis/award', $data);
    }

    public function store($data)
    {
        return $this->performRequest('POST', '/cmis/award', $data);
    }

    public function update($data, $id)
    {
        return $this->performRequest('PUT', '/cmis/award/'.$id, $data);
    }

    public function delete($id)
    {
        return $this->performRequest('DELETE', '/cmis/award/'.$id);
    }

    public function onlyTrashed($data)
    {
        return $this->performRequest('GET', '/cmis/award/only-trashed', $data);
    }

    public function restore($id)
    {
        return $this->performRequest('PUT', '/cmis/award/restore/'.$id);
    }

    public function forceDelete($id)
    {
        return $this->performRequest('DELETE', '/cmis/award/force-delete/'.$id);
    }

    public function searchAwardById($id)
    {
        return $this->performRequest('GET', '/cmis/award/'.$id);
    }

    public function getAwardTypeA($data)
    {
        return $this->performRequest('GET', '/cmis/award/type-a', $data);
    }

    public function getAwardTypeC($data)
    {
        return $this->performRequest('GET', '/cmis/award/type-c', $data);
    }
}
