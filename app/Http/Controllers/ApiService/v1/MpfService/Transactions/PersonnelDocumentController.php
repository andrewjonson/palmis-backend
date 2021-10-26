<?php

namespace App\Http\Controllers\ApiService\v1\MpfService\Transactions;

use App\Http\Controllers\Controller;
use App\Services\ApiService\v1\MpfService\Transactions\PersonnelDocument;
use App\Http\Requests\ApiService\v1\MpfService\Transactions\UploadPersonnelDocumentRequest;

class PersonnelDocumentController extends Controller
{
    public function __construct(PersonnelDocument $apiService)
    {
        $this->apiService = $apiService;
    }

    public function upload(UploadPersonnelDocumentRequest $request, $pmcode)
    {
        $documentTypeId = hashid_decode($request->documentTypeId);
        $attachment = $request->file('attachment');
        $attachmentName = time().'.'.$attachment->extension();
        $attachment->move(public_path('mpf/personneldocuments/'.$pmcode), $attachmentName);

        return $this->apiService->upload([
            'documentTypeId' => $documentTypeId,
            'attachment' => $attachmentName
        ], $pmcode);
    }

    public function getPersonnelDocuments($pmcode)
    {
        return $this->apiService->getPersonnelDocuments($pmcode);
    }

    public function deletePersonnelDocument($id)
    {
        $id = hashid_decode($id);
        $personnelDocument = $this->apiService->getPersonnelDocumentById($id)->{'original'}['data'];
        $pos = strrpos($personnelDocument['attachment'], '/');
        $attachment = substr($personnelDocument['attachment'], $pos);
        if (file_exists(public_path('mpf/personneldocuments/'.$personnelDocument['pmcode'].''.$attachment))) {
            unlink(public_path('mpf/personneldocuments/'.$personnelDocument['pmcode'].''.$attachment));
        }
        return $this->apiService->deletePersonnelDocument($id);
    }
}