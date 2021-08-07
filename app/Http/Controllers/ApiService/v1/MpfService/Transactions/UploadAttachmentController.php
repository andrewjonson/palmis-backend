<?php

namespace App\Http\Controllers\ApiService\v1\MpfService\Transactions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ApiService\v1\MpfService\Transactions\UploadAttachment;

class UploadAttachmentController extends Controller
{
    public function __construct(UploadAttachment $apiService)
    {
        $this->apiService = $apiService;
    }

    public function uploadTabAttachment(Request $request, $tabId)
    {
        return $this->apiService->uploadTabAttachment($request->all(), $tabId);
    }

    public function uploadSubTabAttachment(Request $request, $subTabId)
    {
        return $this->apiService->uploadSubTabAttachment($request->all(), $subTabId);
    }
}