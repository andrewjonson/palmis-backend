<?php

namespace App\Http\Controllers\ApiService\v1\ToeisService\Transactions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ConsumeExternalService;
use App\Services\ApiService\v1\ToeisService\Transactions\Unit;

class UnitController extends Controller
{
    use ConsumeExternalService;

    public function __construct(Unit $apiService)
    {
        $this->middleware('permission:unit-read|admin', [
            'only' => [
                'index'
            ]
        ]);
        $this->middleware('permission:unit-create|admin', [
            'only' => [
                'store'
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
        return $this->apiService->store($request->all());
    }
}