<?php

namespace App\Services\ApiService\v1\SumisService\Transactions;

use App\Traits\ConsumeExternalService;

class IssuanceDirectiveItem
{
    use ConsumeExternalService;

    public $baseUrl;
    public $secret;

    public function __construct()
    {
        $this->baseUrl = config('services.sumis.base_url');
        $this->secret = config('services.sumis.secret');
    }

    public function updateIdItem($data)
    {
        return $this->performRequest('PUT', '/sumis/id-item/update', $data);
    }
}