<?php

namespace App\Services\ApiService\v1\OrderPubService\Transactions;

use App\Traits\ConsumeExternalService;

class OrderRoute
{
    use ConsumeExternalService;

    public $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.orderpub_base_uri');
    }

    public function routeOrder($id)
    {
        return $this->performRequest('POST', '/orderpub/route-order/'.$id);
    }

    public function saveRemarks($data, $id)
    {
        return $this->performRequest('PUT', '/orderpub/update-route/'.$id, $data);
    }

    public function showOrderRoute($id)
    {
        return $this->performRequest('GET', '/orderpub/order-route/'.$id);
    }
}