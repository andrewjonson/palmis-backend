<?php

namespace App\Http\Controllers\ApiService\v1\CmisService\References;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ConsumeExternalService;
use App\Services\ApiService\v1\CmisService\References\Qrs;

class QrsController extends Controller
{
    use ConsumeExternalService;

    public function __construct(Qrs $apiService)
    {
        $this->middleware('permission:qrs-read|admin', [
            'only' => [
                'index',
                'onlyTrashed',
                'searchQrs',
                'searchQrsByName',
                'searchQrsByNameOnly'
            ]
        ]);
        $this->middleware('permission:qrs-create|admin', [
            'only' => [
                'store'
            ]
        ]);
        $this->middleware('permission:qrs-update|admin', [
            'only' => [
                'update',
                'restore'
            ]
        ]);
        $this->middleware('permission:qrs-delete|admin', [
            'only' => [
                'delete',
                'forceDelete'
            ]
        ]);
        $this->apiService = $apiService;
    }

    public function index(Request $request)
    {
        return $this->apiService->index($request->all());
    }

    public function store(Request $request)
    {
        $attachment = $request->file('policy');
        $attachmentName = time().rand(1,100).'.'.$attachment->extension();
        $attachment->move(public_path('cmis/policy'), $attachmentName);

        return $this->apiService->store([
            'name' => $request->name,
            'effectivityStart' => $request->effectivityStart,
            'effectivityEnd' =>  $request->effectivityEnd,
            'docDemsFrom' =>  $request->docDemsFrom,
            'status' =>  $request->status,
            'rf_personnel_type_id' =>  $request->rf_personnel_type_id,
            'rfPurposeId' =>  $request->rfPurposeId,
            'totalPoints' =>  $request->totalPoints,
            'QRSScore' =>  $request->QRSScore,
            'policy' =>  $attachmentName
        ]);
    }

    public function update(Request $request, $id)
    {
        return $this->apiService->update($request->all(), $id);
    }

    public function delete($id)
    {
        return $this->apiService->delete($id);
    }

    public function onlyTrashed(Request $request)
    {
        return $this->apiService->onlyTrashed($request->all());
    }

    public function restore($id)
    {
        return $this->apiService->restore($id);
    }

    public function forceDelete($id)
    {
        return $this->apiService->forceDelete($id);
    }

    public function searchQrs(Request $request)
    {
        return $this->apiService->searchQrs($request->all());
    }

    public function searchQrsByName(Request $request)
    {
        return $this->apiService->searchQrsByName($request->all());
    }

    public function searchQrsByNameOnly(Request $request)
    {
        return $this->apiService->searchQrsByNameOnly($request->all());
    }
}