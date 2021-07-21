<?php

namespace App\Services\ApiService\v1\MpfService\References;

use App\Traits\ConsumeExternalService;

class SubCategory
{
    use ConsumeExternalService;

    public $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.mpf_base_uri');
    }

    public function index($data)
    {
        return $this->performRequest('GET', '/mpf/sub-categories', $data);
    }

    public function store($data)
    {
        return $this->performRequest('POST', '/mpf/sub-categories', $data);
    }

    public function update($data, $id)
    {
        return $this->performRequest('PUT', '/mpf/sub-categories/'.$id, $data);
    }

    public function delete($id)
    {
        return $this->performRequest('DELETE', '/mpf/sub-categories/'.$id);
    }

    public function onlyTrashed($data)
    {
        return $this->performRequest('GET', '/mpf/sub-categories/only-trashed', $data);
    }

    public function restore($id)
    {
        return $this->performRequest('PUT', '/mpf/sub-categories/restore/'.$id);
    }

    public function forceDelete($id)
    {
        return $this->performRequest('DELETE', '/mpf/sub-categories/force-delete/'.$id);
    }
}