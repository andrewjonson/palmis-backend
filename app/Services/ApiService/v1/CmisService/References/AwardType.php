<?php

namespace App\Services\ApiService\v1\CmisService\References;

use App\Traits\ConsumeExternalService;

class AwardType
{
    use ConsumeExternalService;

    public $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.cmis_base_uri');
    }

    public function index($data)
    {
        return $this->performRequest('GET', '/cmis/award/type', $data);
    }

    public function store($data)
    {
        return $this->performRequest('POST', '/cmis/award/type', $data);
    }

    public function update($data, $id)
    {
        return $this->performRequest('PUT', '/cmis/award/type/'.$id, $data);
    }

    public function delete($id)
    {
        return $this->performRequest('DELETE', '/cmis/award/type/'.$id);
    }

    public function onlyTrashed($data)
    {
        return $this->performRequest('GET', '/cmis/award/type/only-trashed', $data);
    }

    public function restore($id)
    {
        return $this->performRequest('PUT', '/cmis/award/type/restore/'.$id);
    }

    public function forceDelete($id)
    {
        return $this->performRequest('DELETE', '/cmis/award/type/force-delete/'.$id);
    }
}