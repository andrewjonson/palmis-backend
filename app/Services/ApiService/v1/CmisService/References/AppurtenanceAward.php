<?php

namespace App\Services\ApiService\v1\CmisService\References;

use App\Traits\ConsumeExternalService;

class AppurtenanceAward
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
        return $this->performRequest('GET', '/cmis/appurtenance-awards', $data);
    }

    public function store($data)
    {
        return $this->performRequest('POST', '/cmis/appurtenance-awards', $data);
    }

    public function update($data, $id)
    {
        return $this->performRequest('PUT', '/cmis/appurtenance-awards/'.$id, $data);
    }

    public function delete($id)
    {
        return $this->performRequest('DELETE', '/cmis/appurtenance-awards/'.$id);
    }

    public function onlyTrashed($data)
    {
        return $this->performRequest('GET', '/cmis/appurtenance-awards/only-trashed', $data);
    }

    public function restore($id)
    {
        return $this->performRequest('PUT', '/cmis/appurtenance-awards/restore/'.$id);
    }

    public function forceDelete($id)
    {
        return $this->performRequest('DELETE', '/cmis/appurtenance-awards/force-delete/'.$id);
    }

    public function getAppurtenanceAward($data)
    {
        return $this->performRequest('GET', '/cmis/search-award', $data);
    }

    public function getAppurtenanceAwardById($id)
    {
        return $this->performRequest('GET', '/cmis/search-appurtenance-award/'. $id);
    }
}