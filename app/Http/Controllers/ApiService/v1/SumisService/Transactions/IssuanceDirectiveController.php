<?php

namespace App\Http\Controllers\ApiService\v1\SumisService\Transactions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ApiService\v1\SumisService\Transactions\IssuanceDirective;

class IssuanceDirectiveController extends Controller
{
    public function __construct(IssuanceDirective $apiService)
    {
        $this->apiService = $apiService;
    }

    public function bulkStore(Request $request)
    {
        return $this->apiService->bulkStore($request->all());
    }

    public function getIssuanceDirective(Request $request)
    {
        return $this->apiService->getIssuanceDirective($request->all());
    }

    public function getIssuanceById($id)
    {
        return $this->apiService->getIssuanceById($id);
    }

    public function createItem(Request $request)
    {
        return $this->apiService->createItem($request->all());
    }

    public function deleteItem($id)
    {
        return $this->apiService->deleteItem($id);
    }

    public function updateIssuanceDirective(Request $request, $id)
    {
        return $this->apiService->updateIssuanceDirective($request->all(), $id);
    }

    public function deleteIssuanceDirective($id)
    {
        return $this->apiService->deleteIssuanceDirective($id);
    }
}