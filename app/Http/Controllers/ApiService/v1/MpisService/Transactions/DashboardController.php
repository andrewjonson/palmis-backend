<?php

namespace App\Http\Controllers\ApiService\v1\MpisService\Transactions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ConsumeExternalService;
use App\Services\ApiService\v1\MpisService\Transactions\Dashboard;

class DashboardController extends Controller
{
    use ConsumeExternalService;

    public function __construct(Dashboard $apiService)
    {
        $this->middleware('permission:dashboard-read|admin', [
            'only' => [
                'getDashboard'
            ]
        ]);
        $this->apiService = $apiService;
    }

    public function getDashboard(Request $request)
    {
        return $this->apiService->getDashboard($request->all());
    }
}