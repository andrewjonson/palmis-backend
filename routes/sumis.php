<?php

require_once __DIR__ . '/Resource.php';

$router->group(['middleware' => ['auth:api', 'verified', 'screenLockDisabled', 'modular:sumis'], 'prefix' => '/api/'.config('app.version').'/sumis'], function() use($router) {
    resource('/supplier', 'SumisService\References\SupplierController', $router);
    resource('/make', 'SumisService\References\MakeController', $router);
    resource('/warehouse', 'SumisService\References\WarehouseController', $router);
    resource('/condition', 'SumisService\References\ConditionController', $router);
    resource('/country', 'SumisService\References\CountryController', $router);
    resource('/signatory', 'SumisService\References\SignatoryController', $router);
    resource('/manufacturer', 'SumisService\References\ManufacturerController', $router);
    resource('/servicing-fpao', 'SumisService\References\ServicingFpaoController', $router);
    resource('/fund-cluster', 'SumisService\References\FundClusterController', $router);
    resource('/office', 'SumisService\References\OfficeController', $router);
    resource('/region', 'SumisService\References\RegionController', $router);
    resource('/fpao', 'SumisService\References\FpaoController', $router);
    resource('/fssu', 'SumisService\References\FssuController', $router);
    resource('/fpao-unit', 'SumisService\References\FpaoUnitController', $router);
    resource('/user-warehouse', 'SumisService\References\UserWarehouseController', $router);
    resource('/responsibility-code', 'SumisService\References\ResponsibilityCodeController', $router);
    resource('/doc-setting', 'SumisService\References\DocSettingController', $router);
    resource('/issuance-directive-purpose', 'SumisService\References\IssuanceDirectivePurposeController', $router);
    resource('/issuance-directive-condition', 'SumisService\References\IssuanceDirectiveConditionController', $router);

    $router->get('/fpaounit/get-unit/{id}', 'ApiService\v1\SumisService\References\FpaoUnitController@filterUnit');

    $router->group(['prefix' => 'ammunition'], function() use($router) {
        resource('/uom', 'SumisService\References\AmmunitionUomController', $router);
        resource('/category', 'SumisService\References\AmmunitionCategoryController', $router);
        resource('/classification', 'SumisService\References\AmmunitionClassificationController', $router);
        resource('/detail', 'SumisService\References\AmmunitionDetailController', $router);
        resource('/nomenclature', 'SumisService\References\AmmunitionNomenclatureController', $router);
        resource('/size-caliber', 'SumisService\References\AmmunitionSizeCaliberController', $router);
        resource('/supply', 'SumisService\References\AmmunitionSupplyController', $router);
        resource('/type', 'SumisService\References\AmmunitionTypeController', $router);
        resource('/head-stump-marking', 'SumisService\References\AmmunitionHeadStumpMarkingController', $router);
        resource('/articles', 'SumisService\References\AmmunitionArticleController', $router);
    
        $router->get('/category-search', 'ApiService\v1\SumisService\References\AmmunitionCategoryController@search');
    });

    //Tally In
    $router->post('/tally-in/store', 'ApiService\v1\SumisService\Transactions\TallyInController@bulkStoreTallyIn');
    $router->get('/tally-in', 'ApiService\v1\SumisService\Transactions\TallyInController@getTallyIn');
    $router->get('/print-tally-in/{id}', 'ApiService\v1\SumisService\Transactions\TallyInController@printTallyIn');
    $router->get('/filter-tally', 'ApiService\v1\SumisService\Transactions\TallyInController@getFilterTally');
    $router->put('/tally/update-tally-in/{id}', 'ApiService\v1\SumisService\Transactions\TallyInController@update');
    $router->delete('/tally/delete-tally-in/{id}', 'ApiService\v1\SumisService\Transactions\TallyInController@deleteTallyIn');

    //RIS
    $router->post('/update-directive-item', 'ApiService\v1\SumisService\Transactions\RisController@updateDirectiveItems');
    $router->get('/ris/get-list', 'ApiService\v1\SumisService\Transactions\RisController@getRisList');
    $router->get('/ris/search/{id}', 'ApiService\v1\SumisService\Transactions\RisController@getRisById');

    //IAR
    $router->group(['prefix' => 'iar'], function() use($router) {
        $router->post('/create/{id}', 'ApiService\v1\SumisService\Transactions\IarController@create');
        $router->get('/get-inventory/{id}', 'ApiService\v1\SumisService\Transactions\IarController@getInventoryByTallyId');
        $router->get('/tally-inventory/{id}', 'ApiService\v1\SumisService\Transactions\IarController@getByTallyId');
        $router->get('/get-list', 'ApiService\v1\SumisService\Transactions\IarController@getIarList');
    });

    //Stock Card
    $router->get('/stockcard/getlist', 'ApiService\v1\SumisService\Transactions\StockCardController@getList');
    $router->get('/stockcard/get-by-id/{id}', 'ApiService\v1\SumisService\Transactions\StockCardController@getStockCardById');

    //Issuance
    $router->group(['prefix' => 'issuance'], function() use($router) {
        $router->get('/get-stockcard', 'ApiService\v1\SumisService\Transactions\StockCardController@getList');
        $router->post('/create', 'ApiService\v1\SumisService\Transactions\IssuanceDirectiveController@bulkStore');
        $router->get('/get-issuance', 'ApiService\v1\SumisService\Transactions\IssuanceDirectiveController@getIssuanceDirective');
        $router->get('/get-by-id/{id}', 'ApiService\v1\SumisService\Transactions\IssuanceDirectiveController@getIssuanceById');
        $router->post('/create-item', 'ApiService\v1\SumisService\Transactions\IssuanceDirectiveController@createItem');
        $router->delete('/delete-item/{id}', 'ApiService\v1\SumisService\Transactions\IssuanceDirectiveController@deleteItem');
        $router->put('/update/{id}', 'ApiService\v1\SumisService\Transactions\IssuanceDirectiveController@updateIssuanceDirective');
        $router->delete('/delete/{id}', 'ApiService\v1\SumisService\Transactions\IssuanceDirectiveController@deleteIssuanceDirective');
    });

    //Issuance Directive Item
    $router->put('/id-item/update', 'ApiService\v1\SumisService\Transactions\IssuanceDirectiveItemController@updateIdItem');

    //Inventory
    $router->get('/inventory', 'ApiService\v1\SumisService\Transactions\InventoryController@get');
    $router->get('/inventory/search-lotnr', 'ApiService\v1\SumisService\Transactions\InventoryController@searchLotNr');

    //Dashboard
    $router->get('/dashboard/per-pamu/{id}', 'ApiService\v1\SumisService\Dashboard\DashboardController@getListNomenclaturePerPamu');

    //Report
    $router->get('/report/tally-in/{id}', 'ApiService\v1\SumisService\Reports\TallyInReportController@getReportTallyIn');
    $router->get('/report/iar/{id}', 'ApiService\v1\SumisService\Reports\IarReportController@getReportIar');
    $router->get('/report/issuance-directive/{id}', 'ApiService\v1\SumisService\Reports\IssuanceDirectiveReportController@getReportIssuanceDirective');
    $router->get('/report/stock-card/{id}', 'ApiService\v1\SumisService\Reports\StockCardReportController@getReportStockCard');
});