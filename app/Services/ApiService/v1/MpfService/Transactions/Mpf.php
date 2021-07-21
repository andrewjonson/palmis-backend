<?php

namespace App\Services\ApiService\v1\MpfService\Transactions;

use App\Traits\ConsumeExternalService;

class Mpf
{
    use ConsumeExternalService;

    public $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.mpf_base_uri');
    }

    public function index($data)
    {
        return $this->performRequest('GET', '/api/v1/mpf/profiles/main', $data);
    }

    public function store($data)
    {
        return $this->performRequest('POST', '/api/v1/mpf/profiles/main', $data);
    }

    public function update($data, $id)
    {
        return $this->performRequest('PUT', '/api/v1/mpf/profiles/main/'.$id, $data);
    }

    public function delete($id)
    {
        return $this->performRequest('DELETE', '/api/v1/mpf/profiles/main/'.$id);
    }

    public function onlyTrashed($data)
    {
        return $this->performRequest('GET', '/api/v1/mpf/profiles/main/only-trashed', $data);
    }

    public function restore($id)
    {
        return $this->performRequest('PUT', '/api/v1/mpf/profiles/main/restore/'.$id);
    }

    public function forceDelete($id)
    {
        return $this->performRequest('DELETE', '/api/v1/mpf/profiles/main/force-delete/'.$id);
    }
}