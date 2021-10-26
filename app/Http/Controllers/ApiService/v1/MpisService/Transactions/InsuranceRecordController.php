<?php

namespace App\Http\Controllers\ApiService\v1\MpisService\Transactions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ConsumeExternalService;
use App\Services\ApiService\v1\MpisService\Transactions\InsuranceRecord;

class InsuranceRecordController extends Controller
{
    use ConsumeExternalService;

    public function __construct(InsuranceRecord $apiService)
    {
        $this->middleware('permission:insurancerecord-read|admin', [
            'only' => [
                'showInsurance',
                'searchInsurance'
            ]
        ]);
        $this->middleware('permission:insurancerecord-create|admin', [
            'only' => [
                'storeInsurance'
            ]
        ]);
        $this->middleware('permission:insurancerecord-update|admin', [
            'only' => [
                'updateInsurance'
            ]
        ]);
        $this->middleware('permission:insurancerecord-delete|admin', [
            'only' => [
                'deleteInsurance'
            ]
        ]);
        $this->apiService = $apiService;
    }

    public function showInsurance($id)
    {
        return $this->apiService->showInsurance($id);
    }

    public function searchInsurance(Request $request)
    {
        return $this->apiService->searchInsurance($request->all());
    }

    public function storeInsurance(Request $request)
    {
        return $this->apiService->storeInsurance($request->all());
    }

    public function updateInsurance(Request $request, $id)
    {
        return $this->apiService->updateInsurance($request->all(), $id);
    }

    public function deleteInsurance($id)
    {
        return $this->apiService->deleteInsurance($id);
    }
}