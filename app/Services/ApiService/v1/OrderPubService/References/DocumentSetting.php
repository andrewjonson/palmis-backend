<?php

namespace App\Services\ApiService\v1\OrderPubService\References;

use App\Traits\ConsumeExternalService;

class DocumentSetting
{
    use ConsumeExternalService;

    public $baseUrl;
    public $secret;

    public function __construct()
    {
        $this->baseUrl = config('services.orderpub.base_url');
        $this->secret = config('services.orderpub.secret');
    }

    public function getDocumentSetting()
    {
        return $this->performRequest('GET', '/orderpub/document-setting');
    }

    public function updateDocumentSetting($data,$id)
    {
        return $this->performRequest('POST', '/orderpub/document-setting/'.$id , $data);
    }

    public function storeDocumentSetting($data)
    {
        return $this->performRequest('POST', '/orderpub/document-setting', $data);
    }
}

