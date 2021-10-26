<?php

namespace App\Http\Controllers\ApiService\v1\MpisService\Transactions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ConsumeExternalService;
use App\Services\ApiService\v1\MpisService\Transactions\FinancialReference;

class FinancialReferenceController extends Controller
{
    use ConsumeExternalService;

    public function __construct(FinancialReference $apiService)
    {
        $this->middleware('permission:financialreference-read|admin', [
            'only' => [
                'getFinancialReference'
            ]
        ]);
        $this->middleware('permission:financialreference-create|admin', [
            'only' => [
                'createFinancialReference'
            ]
        ]);
        $this->middleware('permission:financialreference-update|admin', [
            'only' => [
                'updateFinancial'
            ]
        ]);
        $this->middleware('permission:financialreference-delete|admin', [
            'only' => [
                'deleteFinancial'
            ]
        ]);
        $this->apiService = $apiService;
    }

    public function getFinancialReference($id)
    {
        return $this->apiService->getFinancialReference($id);
    }

    public function createFinancialReference(Request $request)
    {
        return $this->apiService->createFinancialReference($request->all());
    }


    public function updateFinancial(Request $request, $id)
    {
        return $this->apiService->updateFinancial($request->all(), $id);
    }

    public function deleteFinancial($id)
    {
        return $this->apiService->deleteFinancial($id);
    }
}