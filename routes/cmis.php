<?php

require_once __DIR__ . '/Resource.php';

$router->group(['middleware' => ['auth:api', 'verified', 'screenLockDisabled', 'modular:cmis'], 'prefix' => '/api/'.config('app.version').'/cmis'], function() use($router) {
    resource('/appurtenance', 'CmisService\References\AppurtenanceController', $router);
    resource('/appurtenance-awards', 'CmisService\References\AppurtenanceAwardController', $router);
    resource('/subfactor/name', 'CmisService\References\SubFactorController', $router);
    resource('/sublvl1/name', 'CmisService\References\SubFactorLevelOneController', $router);
    resource('/purpose', 'CmisService\References\PurposeController', $router);
    resource('/award', 'CmisService\References\AwardController', $router);
    resource('/award/type', 'CmisService\References\AwardTypeController', $router);
    resource('/award-point', 'CmisService\References\AwardPointController', $router);
    resource('/criteria', 'CmisService\References\CriteriaController', $router);
    resource('/formula', 'CmisService\References\FormulaController', $router);
    resource('/qrs', 'CmisService\References\QrsController', $router);
    resource('/subfactor', 'CmisService\Transactions\TSubFactorController', $router);
    resource('/sublvl1', 'CmisService\Transactions\TSubFactorLevelOneController', $router);

    $router->get('/search-appurtenance', 'ApiService\v1\CmisService\References\AppurtenanceController@getAppurtenances');
    $router->get('/search-appurtenance-award/{id}', 'ApiService\v1\CmisService\References\AppurtenanceAwardController@getAppurtenanceAwardById');
    $router->get('/search-award', 'ApiService\v1\CmisService\References\AppurtenanceAwardController@getAppurtenanceAward');
    $router->get('/search/award-type', 'ApiService\v1\CmisService\References\AwardTypeController@searchAwardType');
    $router->get('/award/type-c', 'ApiService\v1\CmisService\References\AwardController@getAwardTypeC');
    $router->get('/award/type-a', 'ApiService\v1\CmisService\References\AwardController@getAwardTypeA');
    $router->get('/award/{id}', 'ApiService\v1\CmisService\References\AwardController@searchAwardById');
    $router->get('/search/points', 'ApiService\v1\CmisService\Transactions\TSubFactorController@searchPoints');
    $router->get('/search/criteria', 'ApiService\v1\CmisService\Transactions\TSubFactorController@searchByCriteria');
    $router->get('/search/sublvl/dropdown', 'ApiService\v1\CmisService\Transactions\TSubFactorController@getDataByCriteria');
    $router->get('/search/award-points', 'ApiService\v1\CmisService\References\AwardPointController@searchAwardPointBySubfactor');
    $router->get('/search/formula', 'ApiService\v1\CmisService\References\FormulaController@searchFormulaByCriteria');
    $router->get('/search/qrs-name', 'ApiService\v1\CmisService\References\QrsController@searchQrsByName');
    $router->get('/search/qrs/name-only', 'ApiService\v1\CmisService\References\QrsController@searchQrsByNameOnly');
    $router->get('/search', 'ApiService\v1\CmisService\References\QrsController@searchQrs');
    $router->get('/get/criteria/points', 'ApiService\v1\CmisService\References\CriteriaController@getCriteriaPoints');
    $router->get('/search/main-subfactor', 'ApiService\v1\CmisService\References\SubFactorLevelOneController@searchSubLevelByParent');
    $router->get('/search/sublvl/points', 'ApiService\v1\CmisService\References\SubFactorLevelOneController@searchSubLevelPoints');
    $router->get('/search/table-structure', 'ApiService\v1\CmisService\Transactions\TableStructureController@getTableStructureByCriteria');


    $router->post('/promotion', 'ApiService\v1\CmisService\Transactions\PromotionController@createPromotion');
    $router->get('/promotion', 'ApiService\v1\CmisService\Transactions\PromotionController@getPromotion');
    $router->put('/promotion/{id}', 'ApiService\v1\CmisService\Transactions\PromotionController@updatePromotion');
    $router->delete('/promotion/{id}', 'ApiService\v1\CmisService\Transactions\PromotionController@softDeletePromotion');
    $router->put('/promotion/restore/{id}', 'ApiService\v1\CmisService\Transactions\PromotionController@restorePromotion');
    $router->get('/promotion/only-trashed', 'ApiService\v1\CmisService\Transactions\PromotionController@onlyTrashedPromotion');
    $router->delete('/promotion/force-delete/{id}', 'ApiService\v1\CmisService\Transactions\PromotionController@forceDeletePromotion');
    $router->get('/get/promotable-personnel', 'ApiService\v1\CmisService\Transactions\PromotionController@getPromotablePersonnel');
    $router->get('/promotable-per-personnel', 'ApiService\v1\CmisService\Transactions\PromotionController@getPromotablePerPersonnel');

});