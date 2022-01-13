<?php

namespace App\Services\ApiService\v1\SumisService\References;

use App\Traits\ConsumeExternalService;

class Fssu
{
    use ConsumeExternalService;

    public $baseUrl;
    public $secret;

    public function __construct()
    {
        $this->baseUrl = config('services.sumis.base_url');
        $this->secret = config('services.sumis.secret');
    }

    public function index($data)
    {
        return $this->performRequest('GET', '/sumis/fssu', $data);
    }

    public function store($data)
    {
        return $this->performRequest('POST', '/sumis/fssu', $data);
    }

    public function update($data, $id)
    {
        return $this->performRequest('PUT', '/sumis/fssu/'.$id, $data);
    }

    public function delete($id)
    {
        return $this->performRequest('DELETE', '/sumis/fssu/'.$id);
    }

    public function onlyTrashed($data)
    {
        return $this->performRequest('GET', '/sumis/fssu/only-trashed', $data);
    }

    public function restore($id)
    {
        return $this->performRequest('PUT', '/sumis/fssu/restore/'.$id);
    }

    public function forceDelete($id)
    {
        return $this->performRequest('DELETE', '/sumis/fssu/force-delete/'.$id);
    }
}