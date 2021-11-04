<?php

namespace App\Services\ApiService\v1\CmisService\Transactions;

use App\Traits\ConsumeExternalService;

class Promotion
{
    use ConsumeExternalService;

    public $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.cmis_base_uri');
    }

    public function createPromotion($data)
    {
        return $this->performRequest('POST', '/cmis/promotion', $data);
    }

    public function getPromotion($data)
    {
        return $this->performRequest('GET', '/cmis/promotion', $data);
    }

    public function restorePromotion($data,$id)
    {
        return $this->performRequest('PUT', '/cmis/promotion/restore/'.$id, $data);
    }

    public function updatePromotion($data,$id)
    {
        return $this->performRequest('PUT', '/cmis/promotion/'.$id, $data);
    }

    public function softDeletePromotion($id)
    {
        return $this->performRequest('DELETE', '/cmis/promotion/'.$id, $data);
    }

    public function forceDeletePromotion($id)
    {
        return $this->performRequest('DELETE', '/cmis/promotion/force-delete/'.$id, $data);
    }

    public function getPromotablePersonnel($data)
    {
        return $this->performRequest('GET', '/cmis/get/promotable-personnel', $data);
    }

    public function getPromotablePerPersonnel($data)
    {
        return $this->performRequest('GET', '/cmis/promotable-per-personnel', $data);
    }

    public function onlyTrashedPromotion($data)
    {
        return $this->performRequest('GET', '/cmis/promotion/only-trashed', $data);
    }
}