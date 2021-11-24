<?php

namespace App\Services\ApiService\v1\OrderPubService\Transactions;

use App\Traits\ConsumeExternalService;

class OrderRoute
{
    use ConsumeExternalService;

    public $baseUrl;
    public $secret;

    public function __construct()
    {
        $this->baseUrl = config('services.orderpub.base_url');
        $this->secret = config('services.orderpub.secret');
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

    public function showRouteOrders($data)
    {
        return $this->performRequest('GET', '/signatory/route-orders',$data);
    }

    public function showSignatoryOrders($data)
    {
        return $this->performRequest('GET', '/orderpub/signatory-orders',$data);
    }
}