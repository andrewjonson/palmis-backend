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
        return $this->performRequest('GET', '/mpf/profiles/main', $data);
    }

    public function store($data)
    {
        return $this->performRequest('POST', '/mpf/profiles/main', $data);
    }

    public function update($data, $id)
    {
        return $this->performRequest('PUT', '/mpf/profiles/main/'.$id, $data);
    }

    public function delete($id)
    {
        return $this->performRequest('DELETE', '/mpf/profiles/main/'.$id);
    }

    public function onlyTrashed($data)
    {
        return $this->performRequest('GET', '/mpf/profiles/main/only-trashed', $data);
    }

    public function restore($id)
    {
        return $this->performRequest('PUT', '/mpf/profiles/main/restore/'.$id);
    }

    public function forceDelete($id)
    {
        return $this->performRequest('DELETE', '/mpf/profiles/main/force-delete/'.$id);
    }
}