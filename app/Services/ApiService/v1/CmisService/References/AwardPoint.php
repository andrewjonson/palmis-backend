<?php

namespace App\Services\ApiService\v1\CmisService\References;

use App\Traits\ConsumeExternalService;

class AwardPoint
{
    use ConsumeExternalService;

    public $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.cmis_base_uri');
    }

    public function index($data)
    {
        return $this->performRequest('GET', '/cmis/award-point', $data);
    }

    public function store($data)
    {
        return $this->performRequest('POST', '/cmis/award-point', $data);
    }

    public function update($data, $id)
    {
        return $this->performRequest('PUT', '/cmis/award-point/'.$id, $data);
    }

    public function delete($id)
    {
        return $this->performRequest('DELETE', '/cmis/award-point/'.$id);
    }

    public function onlyTrashed($data)
    {
        return $this->performRequest('GET', '/cmis/award-point/only-trashed', $data);
    }

    public function restore($id)
    {
        return $this->performRequest('PUT', '/cmis/award-point/restore/'.$id);
    }

    public function forceDelete($id)
    {
        return $this->performRequest('DELETE', '/cmis/award-point/force-delete/'.$id);
    }

    public function searchAwardPointBySubfactor($data)
    {
        return $this->performRequest('GET', '/cmis/search/award-points', $data);
    }
}