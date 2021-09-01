<?php

require_once __DIR__ . '/Resource.php';

$router->group(['middleware' => ['jwt', 'verified', 'screenLockDisabled', 'modular:cmis'], 'prefix' => '/api/'.config('app.version').'/cmis'], function() use($router) {
    resource('/Appurtenance', 'CmisService\References\Appurtenance', $router);
    resource('/subfactor', 'CmisService\References\SubFactor', $router);
    resource('/sublvl1', 'CmisService\References\SubFactor', $router);
});