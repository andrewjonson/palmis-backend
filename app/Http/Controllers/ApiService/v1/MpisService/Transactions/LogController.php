<?php

namespace App\Http\Controllers\ApiService\v1\MpisService\Transactions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ConsumeExternalService;
use App\Services\ApiService\v1\MpisService\Transactions\Log;

class LogController extends Controller
{
    use ConsumeExternalService;

    public function __construct(Log $apiService)
    {
        $this->middleware('permission:log-read|admin', [
            'only' => [
                'getLogs'
            ]
        ]);
        $this->apiService = $apiService;
    }

    public function getLogs(Request $request)
    {
        return $this->apiService->getLogs($request->all());
    }
}