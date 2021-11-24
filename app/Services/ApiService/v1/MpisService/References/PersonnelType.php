<?php

namespace App\Services\ApiService\v1\MpisService\References;

use App\Traits\ConsumeExternalService;

class PersonnelType
{
    use ConsumeExternalService;

    public $baseUrl;
    public $secret;

    public function __construct()
    {
        $this->baseUrl = config('services.mpis.base_url');
        $this->secret = config('services.mpis.secret');
    }

    public function index($data)
    {
        return $this->performRequest('GET', '/mpis/personnel-type', $data);
    }

    public function store($data)
    {
        return $this->performRequest('POST', '/mpis/personnel-type', $data);
    }

    public function update($data, $id)
    {
        return $this->performRequest('PUT', '/mpis/personnel-type/'.$id, $data);
    }

    public function delete($id)
    {
        return $this->performRequest('DELETE', '/mpis/personnel-type/'.$id);
    }

    public function onlyTrashed($data)
    {
        return $this->performRequest('GET', '/mpis/personnel-type/only-trashed', $data);
    }

    public function restore($id)
    {
        return $this->performRequest('PUT', '/mpis/personnel-type/restore/'.$id);
    }

    public function forceDelete($id)
    {
        return $this->performRequest('DELETE', '/mpis/personnel-type/force-delete/'.$id);
    }

    public function getPersonnelTypeById($id)
    {
        return $this->performRequest('GET', '/mpis/show-personnel-type/'.$id);
    }

}