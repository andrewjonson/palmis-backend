<?php

namespace App\Http\Controllers\ApiService\v1\MpisService\Transactions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ConsumeExternalService;
use App\Services\ApiService\v1\MpisService\Transactions\PersonnelEnlistment;

class PersonnelEnlistmentController extends Controller
{
    use ConsumeExternalService;

    public function __construct(PersonnelEnlistment $apiService)
    {
        $this->middleware('permission:personnelenlistment-create|admin', [
            'only' => [
                'createEnlistment'
            ]
        ]);
        $this->apiService = $apiService;
    }

    public function createEnlistment(Request $request)
    {
        return $this->apiService->createEnlistment($request->all());
    }
}