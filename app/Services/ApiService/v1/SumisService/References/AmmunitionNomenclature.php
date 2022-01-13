<?php

namespace App\Services\ApiService\v1\SumisService\References;

use App\Traits\ConsumeExternalService;

class AmmunitionNomenclature
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
        return $this->performRequest('GET', '/sumis/ammunition/nomenclature', $data);
    }

    public function store($data)
    {
        return $this->performRequest('POST', '/sumis/ammunition/nomenclature', $data);
    }

    public function update($data, $id)
    {
        return $this->performRequest('PUT', '/sumis/ammunition/nomenclature/'.$id, $data);
    }

    public function delete($id)
    {
        return $this->performRequest('DELETE', '/sumis/ammunition/nomenclature/'.$id);
    }

    public function onlyTrashed($data)
    {
        return $this->performRequest('GET', '/sumis/ammunition/nomenclature/only-trashed', $data);
    }

    public function restore($id)
    {
        return $this->performRequest('PUT', '/sumis/ammunition/nomenclature/restore/'.$id);
    }

    public function forceDelete($id)
    {
        return $this->performRequest('DELETE', '/sumis/ammunition/nomenclature/force-delete/'.$id);
    }
}