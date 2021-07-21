<?php

namespace App\Services\ApiService\v1\MpfService\References;

use App\Traits\ConsumeExternalService;

class Tab
{
    use ConsumeExternalService;

    public $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.mpf_base_uri');
    }

    public function getTab($id)
    {
        return $this->performRequest('GET', '/mpf/tabs/'.$id);
    }
}