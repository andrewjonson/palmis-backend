<?php

namespace App\Http\Controllers\ApiService\v1\CmisService\Transactions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ConsumeExternalService;
use App\Services\ApiService\v1\CmisService\Transactions\TableStructure;

class TableStructureController extends Controller
{
    use ConsumeExternalService;

    public function __construct(TableStructure $apiService)
    {
        $this->middleware('permission:tablestructure-read|admin', [
            'only' => [
                'getTableStructureByCriteria'
            ]
        ]);
        $this->apiService = $apiService;
    }

    public function getTableStructureByCriteria(Request $request)
    {
        return $this->apiService->getTableStructureByCriteria($request->all());
    }
}