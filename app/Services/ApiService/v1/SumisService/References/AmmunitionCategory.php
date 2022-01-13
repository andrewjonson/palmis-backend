<?php

namespace App\Services\ApiService\v1\SumisService\References;

use App\Traits\ConsumeExternalService;

class AmmunitionCategory
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
        return $this->performRequest('GET', '/sumis/ammunition/category', $data);
    }

    public function store($data)
    {
        return $this->performRequest('POST', '/sumis/ammunition/category', $data);
    }

    public function update($data, $id)
    {
        return $this->performRequest('PUT', '/sumis/ammunition/category/'.$id, $data);
    }

    public function delete($id)
    {
        return $this->performRequest('DELETE', '/sumis/ammunition/category/'.$id);
    }

    public function onlyTrashed($data)
    {
        return $this->performRequest('GET', '/sumis/ammunition/category/only-trashed', $data);
    }

    public function restore($id)
    {
        return $this->performRequest('PUT', '/sumis/ammunition/category/restore/'.$id);
    }

    public function forceDelete($id)
    {
        return $this->performRequest('DELETE', '/sumis/ammunition/category/force-delete/'.$id);
    }

    public function search($data)
    {
        return $this->performRequest('GET', '/sumis/ammunition/category-search', $data);
    }
}