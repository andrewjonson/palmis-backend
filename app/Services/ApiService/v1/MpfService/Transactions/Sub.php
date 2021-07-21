<?php

namespace App\Services\ApiService\v1\MpfService\Transactions;

use App\Traits\ConsumeExternalService;

class Sub
{
    use ConsumeExternalService;

    public $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.mpf_base_uri');
    }

    public function getSub($id)
    {
        return $this->performRequest('GET', '/mpf/profiles/sub/'.$id);
    }

    public function createSub($data)
    {
        return $this->performRequest('POST', '/mpf/profiles/sub', $data);
    }
}