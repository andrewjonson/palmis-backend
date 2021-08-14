<?php

namespace App\Services\ApiService\v1\OrderPubService\References;

use App\Traits\ConsumeExternalService;

class DocumentSettingSignatory
{
    use ConsumeExternalService;

    public $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.orderpub_base_uri');
    }

    public function index()
    {
        return $this->performRequest('GET', '/orderpub/signatories');
    }

    public function store($data)
    {
        return $this->performRequest('POST', '/orderpub/signatory', $data);
    }

    public function update($data, $id)
    {
        return $this->performRequest('PUT', '/orderpub/signatory/'.$id, $data);
    }

    public function delete($id)
    {
        return $this->performRequest('DELETE', '/orderpub/signatory/'.$id);
    }

    public function onlyTrashed($data)
    {
        return $this->performRequest('GET', '/orderpub/signatory-trashed', $data);
    }

    public function restore($id)
    {
        return $this->performRequest('PUT', '/orderpub/signatory-restore/'.$id);
    }
}