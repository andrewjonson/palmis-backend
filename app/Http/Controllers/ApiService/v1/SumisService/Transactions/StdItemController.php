<?php

namespace App\Http\Controllers\ApiService\v1\SumisService\Transactions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ApiService\v1\SumisService\Transactions\StdItem;

class StdItemController extends Controller
{
    public function __construct(StdItem $apiService)
    {
        $this->apiService = $apiService;
    }

    public function createStdItem(Request $request, $id)
    {
        return $this->apiService->createStdItem($request->all(), $id);
    }

    public function deleteStdItem($id)
    {
        return $this->apiService->deleteStdItem($id);
    }
}