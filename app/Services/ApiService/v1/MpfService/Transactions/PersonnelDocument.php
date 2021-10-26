<?php

namespace App\Services\ApiService\v1\MpfService\Transactions;

use App\Traits\ConsumeExternalService;

class PersonnelDocument
{
    use ConsumeExternalService;

    public $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.mpf_base_uri');
    }

    public function upload(array $data, $pmcode)
    {
        return $this->performRequest('POST', '/mpf/personnel-documents/upload/'.$pmcode, $data);
    }

    public function getPersonnelDocuments($pmcode)
    {
        return $this->performRequest('GET', '/mpf/personnel-documents/'.$pmcode);
    }

    public function deletePersonnelDocument($id)
    {
        return $this->performRequest('DELETE', '/mpf/personnel-documents/'.$id);
    }

    public function getPersonnelDocumentById($id)
    {
        return $this->performRequest('GET', '/mpf/personnel-document-by-id/'.$id);
    }

    public function getPersonnelDocumentByIdPmcode($id, $pmcode)
    {
        return $this->performRequest('GET', '/mpf/personnel-document-by-id-pmcode/'.$id.'/'.$pmcode);
    }
}