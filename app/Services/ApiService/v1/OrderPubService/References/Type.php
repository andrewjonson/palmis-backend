<?php

namespace App\Services\ApiService\v1\OrderPubService\References;

use App\Traits\ConsumeExternalService;

class Type
{
    use ConsumeExternalService;

    public $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.orderpub_base_uri');
    }

    public function index($data)
    {
        return $this->performRequest('GET', '/orderpub/types', $data);
    }

    public function store($data)
    {
        return $this->performRequest('POST', '/orderpub/types', $data);
    }

    public function update($data, $id)
    {
        return $this->performRequest('PUT', '/orderpub/types/'.$id, $data);
    }

    public function delete($id)
    {
        return $this->performRequest('DELETE', '/orderpub/types/'.$id);
    }

    public function onlyTrashed($data)
    {
        return $this->performRequest('GET', '/orderpub/types/only-trashed', $data);
    }

    public function restore($id)
    {
        return $this->performRequest('PUT', '/orderpub/types/restore/'.$id);
    }

    public function forceDelete($id)
    {
        return $this->performRequest('DELETE', '/orderpub/types/force-delete/'.$id);
    }

    public function getTypeByCategory($id)
    {
        return $this->performRequest('GET', '/orderpub/types/category/'.$id);
    }

    public function getModelByType($id)
    {
        return $this->performRequest('GET', '/orderpub/types/model/'.$id);
    }

    public function getTypeWithTemplates($id)
    {
        return $this->performRequest('GET', '/orderpub/types/template/'.$id);
    }

    public function getTypeById($id)
    {
        return $this->performRequest('GET', '/orderpub/types/'.$id);
    }
}