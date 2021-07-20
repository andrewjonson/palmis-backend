<?php

namespace App\Services\ApiServices\v1\MpfService\References;

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
        return $this->performRequest('GET', '/api/v1/mpf/sub-categories', $data);
    }

    public function store($data)
    {
        return $this->performRequest('POST', '/api/v1/mpf/sub-categories', $data);
    }

    public function update($data, $id)
    {
        return $this->performRequest('PUT', '/api/v1/mpf/sub-categories/'.$id, $data);
    }

    public function delete($id)
    {
        return $this->performRequest('DELETE', '/api/v1/mpf/sub-categories/'.$id);
    }

    public function onlyTrashed($data)
    {
        return $this->performRequest('GET', '/api/v1/mpf/sub-categories/only-trashed', $data);
    }

    public function restore($id)
    {
        return $this->performRequest('PUT', '/api/v1/mpf/sub-categories/restore/'.$id);
    }

    public function forceDelete($id)
    {
        return $this->performRequest('DELETE', '/api/v1/mpf/sub-categories/force-delete/'.$id);
    }
}