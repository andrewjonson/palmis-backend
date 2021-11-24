<?php

namespace App\Services\ApiService\v1\OrderPubService\References;

use App\Traits\ConsumeExternalService;

class Status
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
        return $this->performRequest('GET', '/orderpub/statuses', $data);
    }

    public function update($data, $id)
    {
        return $this->performRequest('PUT', '/orderpub/statuses/'.$id, $data);
    }

    public function getStatusById($data)
    {
        return $this->performRequest('GET', '/orderpub/show-status', $data);
    }
}