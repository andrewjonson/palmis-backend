<?php

namespace App\Services\ApiService\v1\OrderPubService\Transactions;

use App\Traits\ConsumeExternalService;

class Order
{
    use ConsumeExternalService;

    public $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.orderpub_base_uri');
    }

    public function getOrders($data)
    {
        return $this->performRequest('GET', '/orderpub/orders',$data);
    }

    public function createGeneralOrder($data,$id)
    {
        return $this->performRequest('POST', '/orderpub/general-order/'.$id, $data);
    }

    public function publishOrder($id)
    {
        return $this->performRequest('PUT', '/orderpub/publish-order/'.$id);
    }

    public function viewPublishOrder($id)
    {
        return $this->performRequest('GET', '/orderpub/view-order/'.$id);
    }
}