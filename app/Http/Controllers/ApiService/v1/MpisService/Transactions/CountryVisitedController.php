<?php

namespace App\Http\Controllers\ApiService\v1\MpisService\Transactions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ConsumeExternalService;
use App\Services\ApiService\v1\MpisService\Transactions\CountryVisited;

class CountryVisitedController extends Controller
{
    use ConsumeExternalService;

    public function __construct(CountryVisited $apiService)
    {
        $this->middleware('permission:countryvisited-read|admin', [
            'only' => [
                'getCountryVisited'
            ]
        ]);
        $this->middleware('permission:countryvisited-create|admin', [
            'only' => [
                'createCountryVisited'
            ]
        ]);
        $this->apiService = $apiService;
    }

    public function getCountryVisited($id)
    {
        return $this->apiService->getCountryVisited($id);
    }

    public function createCountryVisited(Request $request)
    {
        return $this->apiService->createCountryVisited($request->all());
    }
}