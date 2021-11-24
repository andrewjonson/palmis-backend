<?php

namespace App\Services\ApiService\v1\MpisService\References;

use App\Traits\ConsumeExternalService;

class Barangay
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
        return $this->performRequest('GET', '/mpis/barangay', $data);
    }

    public function store($data)
    {
        return $this->performRequest('POST', '/mpis/barangay', $data);
    }

    public function update($data, $id)
    {
        return $this->performRequest('PUT', '/mpis/barangay/'.$id, $data);
    }

    public function delete($id)
    {
        return $this->performRequest('DELETE', '/mpis/barangay/'.$id);
    }

    public function onlyTrashed($data)
    {
        return $this->performRequest('GET', '/mpis/barangay/only-trashed', $data);
    }

    public function restore($id)
    {
        return $this->performRequest('PUT', '/mpis/barangay/restore/'.$id);
    }

    public function forceDelete($id)
    {
        return $this->performRequest('DELETE', '/mpis/barangay/force-delete/'.$id);
    }

    public function getBarangay($data)
    {
        return $this->performRequest('GET', '/mpis/get-barangay', $data);
    }

    public function getBarangayById($id)
    {
        return $this->performRequest('GET', '/mpis/show-barangay/'. $id);
    }
}