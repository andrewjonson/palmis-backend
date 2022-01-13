<?php

namespace App\Http\Controllers\ApiService\v1\SumisService\Transactions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ApiService\v1\SumisService\Transactions\TallyIn;

class TallyInController extends Controller
{
    public function __construct(TallyIn $apiService)
    {
        $this->apiService = $apiService;
    }

    public function bulkStoreTallyIn(Request $request)
    {
        return $this->apiService->bulkStoreTallyIn($request->all());
    }

    public function getTallyIn(Request $request)
    {
        return $this->apiService->getTallyIn($request->all());
    }

    public function printTallyIn($id)
    {
        return $this->apiService->printTallyIn($id);
    }

    public function getFilterTally(Request $request)
    {
        return $this->apiService->getFilterTally($request->all());
    }

    public function update(Request $request, $id)
    {
        return $this->apiService->update($request->all(), $id);
    }

    public function deleteTallyIn($id)
    {
        return $this->apiService->deleteTallyIn($id);
    }
}