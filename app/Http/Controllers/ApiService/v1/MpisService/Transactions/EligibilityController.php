<?php

namespace App\Http\Controllers\ApiService\v1\MpisService\Transactions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ConsumeExternalService;
use App\Services\ApiService\v1\MpisService\Transactions\Eligibility;

class EligibilityController extends Controller
{
    use ConsumeExternalService;

    public function __construct(Eligibility $apiService)
    {
        $this->middleware('permission:eligibility-read|admin', [
            'only' => [
                'getEligibility'
            ]
        ]);
        $this->middleware('permission:eligibility-create|admin', [
            'only' => [
                'createEligibility'
            ]
        ]);
        $this->apiService = $apiService;
    }

    public function getEligibility($id)
    {
        return $this->apiService->getEligibility($id);
    }

    public function createEligibility(Request $request)
    {
        return $this->apiService->createEligibility($request->all());
    }
}