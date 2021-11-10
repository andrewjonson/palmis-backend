<?php

namespace App\Http\Controllers\ApiService\v1\MpisService\Transactions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ApiService\v1\MpisService\Transactions\IDSystem;

class IDSystemController extends Controller
{
    public function __construct(IDSystem $apiService)
    {
        $this->apiService = $apiService;
    }

    public function createIdSystem(Request $request)
    {
        return $this->apiService->createIdSystem($request->all());
    }

    public function getIdSystem(Request $request)
    {
        return $this->apiService->getIdSystem($request->all());
    }

    public function showIdSystem(Request $request)
    {
        return $this->apiService->showIdSystem($request->all());
    }
}