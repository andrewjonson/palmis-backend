<?php

namespace App\Services\ApiService\v1\MpisService\References;

use App\Traits\ConsumeExternalService;

class Qualification
{
    use ConsumeExternalService;

    public $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.mpis_base_uri');
    }

    public function index($data)
    {
        return $this->performRequest('GET', '/mpis/qualifications', $data);
    }

    public function store($data)
    {
        return $this->performRequest('POST', '/mpis/qualifications', $data);
    }

    public function update($data, $id)
    {
        return $this->performRequest('PUT', '/mpis/qualifications/'.$id, $data);
    }

    public function delete($id)
    {
        return $this->performRequest('DELETE', '/mpis/qualifications/'.$id);
    }

    public function onlyTrashed($data)
    {
        return $this->performRequest('GET', '/mpis/qualifications/only-trashed', $data);
    }

    public function restore($id)
    {
        return $this->performRequest('PUT', '/mpis/qualifications/restore/'.$id);
    }

    public function forceDelete($id)
    {
        return $this->performRequest('DELETE', '/mpis/qualifications/force-delete/'.$id);
    }
}