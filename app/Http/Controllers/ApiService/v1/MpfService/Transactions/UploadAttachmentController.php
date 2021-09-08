<?php

namespace App\Http\Controllers\ApiService\v1\MpfService\Transactions;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ApiService\v1\MpfService\Transactions\UploadAttachment;
use App\Http\Requests\ApiService\v1\MpfService\Transactions\UploadTabRequest;

class UploadAttachmentController extends Controller
{
    public function __construct(UploadAttachment $apiService)
    {
        $this->apiService = $apiService;
    }

    public function uploadTabAttachment(UploadTabRequest $request, $tabId)
    {
        $folderId = hashid_decode($request->folderId);
        $pmcode = $request->pmcode;
        foreach($request->file('attachments') as $attachment) {
            $attachmentName = time().rand(1,100).'.'.$attachment->extension();
            $attachment->move(public_path('mpf/tabattachments/'.$pmcode), $attachmentName);
            $attachments[] = $attachmentName;
        }
        
        return $this->apiService->uploadTabAttachment([
            'pmcode' => $pmcode,
            'folderId' => $folderId,
            'attachments' => $attachments
        ], $tabId);
    }

    public function uploadSubTabAttachment(UploadTabRequest $request, $subTabId)
    {
        $folderId = hashid_decode($request->folderId);
        $pmcode = $request->pmcode;
        foreach($request->file('attachments') as $attachment) {
            $attachmentName = time().rand(1,100).'.'.$attachment->extension();
            $attachment->move(public_path('mpf/subtabattachments/'.$pmcode), $attachmentName);
            $attachments[] = $attachmentName;
        }

        return $this->apiService->uploadSubTabAttachment([
            'pmcode' => $pmcode,
            'folderId' => $folderId,
            'attachments' => $attachments
        ], $subTabId);
    }
}