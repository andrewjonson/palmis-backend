<?php

namespace App\Services\ApiService\v1\MpfService\References;

use App\Traits\ConsumeExternalService;

class Folder
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
        return $this->performRequest('GET', '/mpf/folders', $data);
    }

    public function store($data)
    {
        return $this->performRequest('POST', '/mpf/folders', $data);
    }

    public function update($data, $id)
    {
        return $this->performRequest('PUT', '/mpf/folders/'.$id, $data);
    }

    public function delete($id)
    {
        return $this->performRequest('DELETE', '/mpf/folders/'.$id);
    }

    public function onlyTrashed($data)
    {
        return $this->performRequest('GET', '/mpf/folders/only-trashed', $data);
    }

    public function restore($id)
    {
        return $this->performRequest('PUT', '/mpf/folders/restore/'.$id);
    }

    public function forceDelete($id)
    {
        return $this->performRequest('DELETE', '/mpf/folders/force-delete/'.$id);
    }
}