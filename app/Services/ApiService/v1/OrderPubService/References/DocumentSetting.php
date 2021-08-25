<?php

namespace App\Services\ApiService\v1\OrderPubService\References;

use App\Traits\ConsumeExternalService;

class DocumentSetting
{
    use ConsumeExternalService;

    public $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.orderpub_base_uri');
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

