<?php

namespace App\Services\ApiService\v1\MpfService\Transactions;

use App\Traits\ConsumeExternalService;

class UploadAttachment
{
    use ConsumeExternalService;

    public $baseUrl;
    public $secret;

    public function __construct()
    {
        $this->baseUrl = config('services.mpf.base_url');
        $this->secret = config('services.mpf.secret');
    }

    public function uploadTabAttachment($data, $tabId)
    {
        return $this->performRequest('POST', '/mpf/tab-attachments/upload/'.$tabId, $data);
    }

    public function uploadSubTabAttachment($data, $subTabId)
    {
        return $this->performRequest('POST', '/mpf/sub-tab-attachments/upload/'.$subTabId, $data);
    }

    public function deleteTabAttachment($id)
    {
        return $this->performRequest('DELETE', '/mpf/tab-attachments/delete/'.$id);
    }

    public function deleteSubTabAttachment($id)
    {
        return $this->performRequest('DELETE', '/mpf/sub-tab-attachments/delete/'.$id);
    }
}