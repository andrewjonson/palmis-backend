<?php

namespace App\Http\Controllers\ApiService\v1\SumisService\Transactions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ApiService\v1\SumisService\Transactions\IssuanceDirectiveItem;

class IssuanceDirectiveItemController extends Controller
{
    public function __construct(IssuanceDirectiveItem $apiService)
    {
        $this->apiService = $apiService;
    }

    public function updateIdItem(Request $request)
    {
        return $this->apiService->updateIdItem($request->all());
    }
}