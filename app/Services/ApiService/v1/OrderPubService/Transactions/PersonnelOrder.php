<?php

namespace App\Services\ApiService\v1\OrderPubService\Transactions;

use App\Traits\ConsumeExternalService;

class PersonnelOrder
{
    use ConsumeExternalService;

    public $baseUrl;
    public $secret;

    public function __construct()
    {
        $this->baseUrl = config('services.orderpub.base_url');
        $this->secret = config('services.orderpub.secret');
    }

    public function getOrderByOrderCode($orderCode)
    {
        return $this->performRequest('GET', '/orderpub/show-order/'.$orderCode);
    }

    public function getOrderCodeDetails($orderCode)
    {
        return $this->performRequest('GET', '/orderpub/show-order-details/'.$orderCode);
    }
}