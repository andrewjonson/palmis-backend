<?php

namespace App\Services\ApiService\v1\MpisService\References;

use App\Traits\ConsumeExternalService;

class MuniCity
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
        return $this->performRequest('GET', '/mpis/municity', $data);
    }

    public function store($data)
    {
        return $this->performRequest('POST', '/mpis/municity', $data);
    }

    public function update($data, $id)
    {
        return $this->performRequest('PUT', '/mpis/municity/'.$id, $data);
    }

    public function delete($id)
    {
        return $this->performRequest('DELETE', '/mpis/municity/'.$id);
    }

    public function onlyTrashed($data)
    {
        return $this->performRequest('GET', '/mpis/municity/only-trashed', $data);
    }

    public function restore($id)
    {
        return $this->performRequest('PUT', '/mpis/municity/restore/'.$id);
    }

    public function forceDelete($id)
    {
        return $this->performRequest('DELETE', '/mpis/municity/force-delete/'.$id);
    }

    public function getMunicity($data)
    {
        return $this->performRequest('GET', '/mpis/get-municity', $data);
    }

    public function getMunicityById($id)
    {
        return $this->performRequest('GET', '/mpis/show-municity/'.$id);
    }

}