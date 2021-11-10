<?php

namespace App\Services\ApiService\v1\MpisService\Transactions;

use App\Traits\ConsumeExternalService;

class PersonnelPromotion
{
    use ConsumeExternalService;

    public $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.mpis_base_uri');
    }

    public function createPersonnelPromotion($data)
    {
        return $this->performRequest('POST', '/mpis/store-personnel-promotion', $data);
    }

    public function showPersonnelPromotion($id)
    {
        return $this->performRequest('GET', '/mpis/show-personnel-promotion/'. $id);
    }

    public function showOrderPromotionDetail($id)
    {
        return $this->performRequest('GET', '/mpis/show-order-promotion-detail/'. $id);
    }
}