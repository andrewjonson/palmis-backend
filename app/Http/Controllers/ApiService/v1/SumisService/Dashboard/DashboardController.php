<?php

namespace App\Http\Controllers\ApiService\v1\SumisService\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\ApiService\v1\SumisService\Dashboard\Dashboard;

class DashboardController extends Controller
{
    public function __construct(Dashboard $apiService)
    {
        $this->apiService = $apiService;
    }

    public function getListNomenclaturePerPamu($id)
    {
        return $this->apiService->getListNomenclaturePerPamu($id);
    }
}