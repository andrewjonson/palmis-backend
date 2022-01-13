<?php

namespace App\Http\Controllers\ApiService\v1\SumisService\Transactions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ApiService\v1\SumisService\Transactions\Iar;

class IarController extends Controller
{
    public function __construct(Iar $apiService)
    {
        $this->apiService = $apiService;
    }

    public function create(Request $request, $id)
    {
        return $this->apiService->create($request->all(), $id);
    }

    public function getInventoryByTallyId($id)
    {
        return $this->apiService->getInventoryByTallyId($id);
    }

    public function getByTallyId($id)
    {
        return $this->apiService->getByTallyId($id);
    }

    public function getIarList(Request $request)
    {
        return $this->apiService->getIarList($request->all());
    }
}