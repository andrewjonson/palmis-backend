<?php

namespace App\Services\ApiService\v1\OrderPubService\Transactions;

use App\Traits\ConsumeExternalService;

class PersonnelOrder
{
    use ConsumeExternalService;

    public $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.orderpub_base_uri');
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