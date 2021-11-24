<?php

require_once __DIR__ . '/Resource.php';

$router->group(['middleware' => ['client.credentials', 'verified', 'screenLockDisabled', 'modular:toeis'], 'prefix' => '/api/'.config('app.version').'/toeis'], function() use($router) {
    resource('/echelons', 'ToeisService\References\EchelonController', $router);

    $router->get('/unit-all-active', 'ApiService\v1\ToeisService\Transactions\UnitController@index');
    $router->get('/unit-per-id/{id}', 'ApiService\v1\ToeisService\Transactions\UnitController@getUnitById');
    $router->get('/unit-concat/{id}', 'ApiService\v1\ToeisService\Transactions\UnitController@getUnitConcatById');
});