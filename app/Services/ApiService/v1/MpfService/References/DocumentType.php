<?php

namespace App\Services\ApiService\v1\MpfService\References;

use App\Traits\ConsumeExternalService;

class DocumentType
{
    use ConsumeExternalService;

    public $baseUrl;
    public $secret;

    public function __construct()
    {
        $this->baseUrl = config('services.mpf.base_url');
        $this->secret = config('services.mpf.secret');
    }

    public function index($data)
    {
        return $this->performRequest('GET', '/mpf/documenttypes', $data);
    }

    public function store($data)
    {
        return $this->performRequest('POST', '/mpf/documenttypes', $data);
    }

    public function update($data, $id)
    {
        return $this->performRequest('PUT', '/mpf/documenttypes/'.$id, $data);
    }

    public function delete($id)
    {
        return $this->performRequest('DELETE', '/mpf/documenttypes/'.$id);
    }

    public function onlyTrashed($data)
    {
        return $this->performRequest('GET', '/mpf/documenttypes/only-trashed', $data);
    }

    public function restore($id)
    {
        return $this->performRequest('PUT', '/mpf/documenttypes/restore/'.$id);
    }

    public function forceDelete($id)
    {
        return $this->performRequest('DELETE', '/mpf/documenttypes/force-delete/'.$id);
    }
}