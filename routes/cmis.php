<?php

require_once __DIR__ . '/Resource.php';

$router->group(['middleware' => ['jwt', 'verified', 'screenLockDisabled', 'modular:cmis'], 'prefix' => '/api/'.config('app.version').'/cmis'], function() use($router) {
    resource('/appurtenance', 'CmisService\References\AppurtenanceController', $router);
    resource('/subfactor', 'CmisService\References\SubFactorController', $router);
    resource('/sublvl1', 'CmisService\References\SubLevelOneController', $router);
    resource('/purpose', 'CmisService\References\PurposeController', $router);
    resource('/award', 'CmisService\References\AwardController', $router);
});