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
                'index',
                'getUnitById',
                'getUnitConcatById',
                'getUnit',
                'getToggleUnit'
            ]
        ]);
        $this->middleware('permission:unit-create|admin', [
            'only' => [
                'createUnit'
            ]
        ]);
        $this->apiService = $apiService;
    }

    public function index(Request $request)
    {
        return $this->apiService->index($request->all());
    }

    public function getUnitById($id)
    {
        return $this->apiService->getUnitById($id);
    }

    public function getUnitConcatById($id)
    {
        return $this->apiService->getUnitConcatById($id);
    }

    public function getUnit($id)
    {
        return $this->apiService->getUnit($id);
    }

    public function createUnit(Request $request)
    {
        return $this->apiService->createUnit($request->all());
    }

    public function getToggleUnit($id)
    {
        return $this->apiService->getToggleUnit($id);
    }
}