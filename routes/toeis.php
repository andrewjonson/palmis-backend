<?php

require_once __DIR__ . '/Resource.php';

$router->group(['middleware' => ['auth:api', 'verified', 'screenLockDisabled', 'modular:toeis'], 'prefix' => '/api/'.config('app.version').'/toeis'], function() use($router) {
    resource('/echelons', 'ToeisService\References\EchelonController', $router);

    $router->post('/unit-all-active', 'ApiService\v1\ToeisService\Transactions\UnitController@index');
    $router->post('/unit-per-id/{id}', 'ApiService\v1\ToeisService\Transactions\UnitController@getUnitById');
    $router->post('/unit-concat/{id}', 'ApiService\v1\ToeisService\Transactions\UnitController@getUnitConcatById');
});