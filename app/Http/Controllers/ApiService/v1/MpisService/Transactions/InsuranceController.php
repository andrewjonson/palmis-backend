<?php

namespace App\Http\Controllers\ApiService\v1\MpisService\Transactions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ConsumeExternalService;
use App\Services\ApiService\v1\MpisService\Transactions\Insurance;

class InsuranceController extends Controller
{
    use ConsumeExternalService;

    public function __construct(Insurance $apiService)
    {
        $this->middleware('permission:insurance-read|admin', [
            'only' => [
                'getInsurance'
            ]
        ]);
        $this->middleware('permission:insurance-create|admin', [
            'only' => [
                'createInsurance'
            ]
        ]);
        $this->apiService = $apiService;
    }

    public function getInsurance($id)
    {
        return $this->apiService->getInsurance($id);
    }

    public function createInsurance(Request $request)
    {
        return $this->apiService->createInsurance($request->all());
    }
}