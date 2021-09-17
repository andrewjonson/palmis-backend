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

    public function reviseGeneralOrder($data,$id)
    {
        return $this->performRequest('PUT', '/orderpub/revise-general-order/'.$id);
    }

    public function publishOrder($id)
    {
        return $this->performRequest('PUT', '/orderpub/publish-order/'.$id);
    }

    public function viewPublishOrder($id)
    {
        return $this->performRequest('GET', '/orderpub/view-order/'.$id);
    }

    public function viewDraftOrder($id)
    {
        return $this->performRequest('GET', '/orderpub/view-draft-order/'.$id);
    }

    public function saveOrderAsTemplate($data, $id)
    {
        return $this->performRequest('POST', '/orderpub/orders/templates/'.$id, $data);
    }

    public function getDraftOrders($data)
    {
        return $this->performRequest('GET', '/orderpub/order-drafts',$data);
    }

    public function getPublishedOrders($data)
    {
        return $this->performRequest('GET', '/orderpub/published-drafts',$data);
    }

    public function getOrderHistories($id)
    {
        return $this->performRequest('GET', '/orderpub/order-histories/'.$id);
    }
}