<?php

namespace App\Http\Controllers\ApiService\v1\MpisService\Transactions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ConsumeExternalService;
use App\Services\ApiService\v1\MpisService\Transactions\SerialNumber;

class SerialNumberController extends Controller
{
    use ConsumeExternalService;

    public function __construct(SerialNumber $apiService)
    {
        $this->middleware('permission:serialnumber-create|admin', [
            'only' => [
                'createSerialNumber'
            ]
        ]);
        $this->apiService = $apiService;
    }
    public function createSerialNumber(Request $request)
    {
        return $this->apiService->createSerialNumber($request->all());
    }
}