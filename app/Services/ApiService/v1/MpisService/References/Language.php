<?php

namespace App\Services\ApiService\v1\MpisService\References;

use App\Traits\ConsumeExternalService;

class Language
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
        return $this->performRequest('GET', '/mpis/language', $data);
    }

    public function store($data)
    {
        return $this->performRequest('POST', '/mpis/language', $data);
    }

    public function update($data, $id)
    {
        return $this->performRequest('PUT', '/mpis/language/'.$id, $data);
    }

    public function delete($id)
    {
        return $this->performRequest('DELETE', '/mpis/language/'.$id);
    }

    public function onlyTrashed($data)
    {
        return $this->performRequest('GET', '/mpis/language/only-trashed', $data);
    }

    public function restore($id)
    {
        return $this->performRequest('PUT', '/mpis/language/restore/'.$id);
    }

    public function forceDelete($id)
    {
        return $this->performRequest('DELETE', '/mpis/language/force-delete/'.$id);
    }
}