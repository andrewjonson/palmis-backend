<?php

namespace App\Services\ApiService\v1\MpfService\References;

use App\Traits\ConsumeExternalService;

class Group
{
    use ConsumeExternalService;

    public $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.mpf_base_uri');
    }

    public function index($data)
    {
        return $this->performRequest('GET', '/api/v1/mpf/groups', $data);
    }

    public function store($data)
    {
        return $this->performRequest('POST', '/api/v1/mpf/groups', $data);
    }

    public function update($data, $id)
    {
        return $this->performRequest('PUT', '/api/v1/mpf/groups/'.$id, $data);
    }

    public function delete($id)
    {
        return $this->performRequest('DELETE', '/api/v1/mpf/groups/'.$id);
    }

    public function onlyTrashed($data)
    {
        return $this->performRequest('GET', '/api/v1/mpf/groups/only-trashed', $data);
    }

    public function restore($id)
    {
        return $this->performRequest('PUT', '/api/v1/mpf/groups/restore/'.$id);
    }

    public function forceDelete($id)
    {
        return $this->performRequest('DELETE', '/api/v1/mpf/groups/force-delete/'.$id);
    }
}