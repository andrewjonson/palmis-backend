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
        $year = $request->year;
        $pmcode = $request->pmcode;
        $data = $request->except('attachment');
        $data['attachment'] = time().'.'.$request->attachment->getClientOriginalExtension();
        $request->attachment->move(public_path('mpf/tabattachments/'.$year.'/'.$pmcode), $data['attachment']);
        return $this->apiService->uploadTabAttachment($data, $tabId);
    }

    public function uploadSubTabAttachment(Request $request, $subTabId)
    {
        $year = $request->year;
        $pmcode = $request->pmcode;
        $data = $request->except('attachment');
        $data['attachment'] = time().'.'.$request->attachment->getClientOriginalExtension();
        $request->attachment->move(public_path('mpf/subtabattachments/'.$year.'/'.$pmcode), $data['attachment']);
        return $this->apiService->uploadSubTabAttachment($data, $subTabId);
    }
}