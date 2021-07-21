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
        return $this->performRequest('GET', '/mpf/groups', $data);
    }

    public function store($data)
    {
        return $this->performRequest('POST', '/mpf/groups', $data);
    }

    public function update($data, $id)
    {
        return $this->performRequest('PUT', '/mpf/groups/'.$id, $data);
    }

    public function delete($id)
    {
        return $this->performRequest('DELETE', '/mpf/groups/'.$id);
    }

    public function onlyTrashed($data)
    {
        return $this->performRequest('GET', '/mpf/groups/only-trashed', $data);
    }

    public function restore($id)
    {
        return $this->performRequest('PUT', '/mpf/groups/restore/'.$id);
    }

    public function forceDelete($id)
    {
        return $this->performRequest('DELETE', '/mpf/groups/force-delete/'.$id);
    }
}