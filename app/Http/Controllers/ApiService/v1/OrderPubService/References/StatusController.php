<?php

namespace App\Http\Controllers\ApiService\v1\OrderPubService\References;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ConsumeExternalService;
use App\Services\ApiService\v1\OrderPubService\References\Status;

class StatusController extends Controller
{
    use ConsumeExternalService;

    public function __construct(Status $apiService)
    {
        $this->middleware('permission:status-read|admin', [
            'only' => [
                'index',
                'getStatusById'
            ]
        ]);
        $this->middleware('permission:status-update|admin', [
            'only' => [
                'update'
            ]
        ]);
        $this->apiService = $apiService;
    }

    public function index(Request $request)
    {
        return $this->apiService->index($request->all());
    }

    public function update(Request $request, $id)
    {
        return $this->apiService->update($request->all(), $id);
    }

    public function getStatusById(Request $request)
    {
        return $this->apiService->getStatusById($request->all());
    }
}