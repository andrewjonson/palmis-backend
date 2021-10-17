<?php

require_once __DIR__ . '/Resource.php';

$router->group(['middleware' => ['auth:api', 'verified', 'screenLockDisabled', 'modular:toeis'], 'prefix' => '/api/'.config('app.version').'/toeis'], function() use($router) {
    resource('/echelons', 'ToeisService\References\EchelonController', $router);
});