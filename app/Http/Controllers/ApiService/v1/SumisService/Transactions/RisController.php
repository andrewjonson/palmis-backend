<?php

namespace App\Http\Controllers\ApiService\v1\SumisService\Transactions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ApiService\v1\SumisService\Transactions\Ris;

class RisController extends Controller
{
    public function __construct(Ris $apiService)
    {
        $this->apiService = $apiService;
    }

    public function updateDirectiveItems(Request $request)
    {
        return $this->apiService->updateDirectiveItems($request->all());
    }

    public function getRisList(Request $request)
    {
        return $this->apiService->getRisList($request->all());
    }

    public function getRisById($id)
    {
        return $this->apiService->getRisById($id);
    }
}