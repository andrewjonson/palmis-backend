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

    public function destroy($id)
    {
        return $this->performRequest('DELETE', '/orderpub/order/'.$id);
    }

    public function forceDelete($id)
    {
        return $this->performRequest('DELETE', '/orderpub/order/force-delete/'.$id);
    }

    public function restore($id)
    {
        return $this->performRequest('PUT', '/orderpub/order/restore/'.$id);
    }

    public function onlyTrashed($data)
    {
        return $this->performRequest('GET', '/orderpub/order/only-trashed',$data);
    }

    public function createGeneralOrder($data,$id)
    {
        return $this->performRequest('POST', '/orderpub/general-order/'.$id, $data);
    }

    public function reviseGeneralOrder($data,$id)
    {
        return $this->performRequest('PUT', '/orderpub/revise-general-order/'.$id);
    }

    public function updateGeneralOrder($data,$id)
    {
        return $this->performRequest('POST', '/orderpub/update-general-order/'.$id);
    }

    public function publishOrder($id)
    {
        return $this->performRequest('PUT', '/orderpub/publish-order/'.$id);
    }

    public function viewPublishOrder($id)
    {
        return $this->performRequest('GET', '/orderpub/order/'.$id);
    }

    public function viewDraftOrder($versionId)
    {
        return $this->performRequest('GET', '/orderpub/view-order/'.$versionId);
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
        return $this->performRequest('GET', '/orderpub/published-orders',$data);
    }

    public function getOrderHistories($id)
    {
        return $this->performRequest('GET', '/orderpub/order-histories/'.$id);
    }
}