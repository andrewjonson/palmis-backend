<?php

namespace App\Services\ApiService\v1\OrderPubService\References;

use App\Traits\ConsumeExternalService;

class ModelList
{
    use ConsumeExternalService;

    public $baseUrl;
    public $secret;

    public function __construct()
    {
        $this->baseUrl = config('services.orderpub.base_url');
        $this->secret = config('services.orderpub.secret');
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