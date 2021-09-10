<?php

namespace App\Http\Controllers\ApiService\v1\MpisService\Transactions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ConsumeExternalService;
use App\Services\ApiService\v1\MpisService\Transactions\TarrifSize;

class TarrifSizeController extends Controller
{
    use ConsumeExternalService;

    public function __construct(TarrifSize $apiService)
    {
        $this->middleware('permission:tarrifsize-read|admin', [
            'only' => [
                'getTarrifSizeById'
            ]
        ]);
        $this->middleware('permission:tarrifsize-create|admin', [
            'only' => [
                'createTarrifSize'
            ]
        ]);
        $this->apiService = $apiService;
    }

    public function getTarrifSizeById($id)
    {
        return $this->apiService->getTarrifSizeById($id);
    }

    public function createTarrifSize(Request $request)
    {
        return $this->apiService->createTarrifSize($request->all());
    }
}