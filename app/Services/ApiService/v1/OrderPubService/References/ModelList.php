<?php

namespace App\Services\ApiService\v1\OrderPubService\References;

use App\Traits\ConsumeExternalService;

class ModelList
{
    use ConsumeExternalService;

    public $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.orderpub_base_uri');
    }

    public function index($data)
    {
        return $this->performRequest('GET', '/orderpub/models', $data);
    }

    public function getModelbyType($id)
    {
        return $this->performRequest('GET', '/orderpub/models/type/'.$id);
    }
}