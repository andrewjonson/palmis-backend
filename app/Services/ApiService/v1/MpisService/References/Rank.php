<?php

namespace App\Services\ApiService\v1\MpisService\References;

use App\Traits\ConsumeExternalService;

class Rank
{
    use ConsumeExternalService;

    public $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.mpis_base_uri');
    }

    public function index($data)
    {
        return $this->performRequest('GET', '/mpis/rank', $data);
    }

    public function store($data)
    {
        return $this->performRequest('POST', '/mpis/rank', $data);
    }

    public function update($data, $id)
    {
        return $this->performRequest('PUT', '/mpis/rank/'.$id, $data);
    }

    public function delete($id)
    {
        return $this->performRequest('DELETE', '/mpis/rank/'.$id);
    }

    public function onlyTrashed($data)
    {
        return $this->performRequest('GET', '/mpis/rank/only-trashed', $data);
    }

    public function restore($id)
    {
        return $this->performRequest('PUT', '/mpis/rank/restore/'.$id);
    }

    public function forceDelete($id)
    {
        return $this->performRequest('DELETE', '/mpis/rank/force-delete/'.$id);
    }

    public function getRankById($id)
    {
        return $this->performRequest('GET', '/mpis/show-rank/'. $id);
    }

    public function searchPersonnelRank($data)
    {
        return $this->performRequest('GET', '/mpis/search-personnel-rank', $data);
    }
}