<?php

require_once __DIR__ . '/Resource.php';

$router->group(['middleware' => ['jwt', 'verified', 'screenLockDisabled', 'modular:cmis'], 'prefix' => '/api/'.config('app.version').'/cmis'], function() use($router) {
    resource('/appurtenance', 'CmisService\References\AppurtenanceController', $router);
    resource('/subfactor', 'CmisService\References\SubFactorController', $router);
    resource('/sublvl1', 'CmisService\References\SubFactorLevelOneController', $router);
    resource('/purpose', 'CmisService\References\PurposeController', $router);
    resource('/award', 'CmisService\References\AwardController', $router);
    resource('/award/type', 'CmisService\References\AwardController', $router);
    resource('/award-point', 'CmisService\References\AwardPointController', $router);
    resource('/criteria', 'CmisService\References\CriteriaController', $router);
    resource('/formula', 'CmisService\References\FormulaController', $router);
    resource('/qrs', 'CmisService\References\QrsController', $router);

    $router->get('/search/main-subfactor', 'ApiService\v1\CmisService\References\SubFactorLevelOneController@searchSubLevelByParent');
    $router->get('/search/sublvl/points', 'ApiService\v1\CmisService\References\SubFactorLevelOneController@searchSubLevelPoints');
    $router->get('/search/criteria', 'ApiService\v1\CmisService\References\SubFactorController@searchSubfactorByCriteriaAndQrs');
    $router->get('/search/sublvl/dropdown', 'ApiService\v1\CmisService\References\SubFactorController@getDataByCriteria');
});