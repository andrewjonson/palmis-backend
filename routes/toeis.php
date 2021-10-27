<?php

require_once __DIR__ . '/Resource.php';

$router->group(['middleware' => ['auth:api', 'verified', 'screenLockDisabled', 'modular:toeis'], 'prefix' => '/api/'.config('app.version').'/toeis'], function() use($router) {
    resource('/echelons', 'ToeisService\References\EchelonController', $router);
    resource('/unit-locations', 'ToeisService\References\UnitLocationController', $router);
    resource('/assignments', 'ToeisService\References\AssignmentController', $router);

    $router->get('/unit-all-active', 'ApiService\v1\ToeisService\Transactions\UnitController@index');
    $router->get('/unit-per-id/{id}', 'ApiService\v1\ToeisService\Transactions\UnitController@getUnitById');
    $router->get('/unit-concat/{id}', 'ApiService\v1\ToeisService\Transactions\UnitController@getUnitConcatById');
    $router->post('/unit', 'ApiService\v1\ToeisService\Transactions\UnitController@createUnit');
    $router->get('/toggle-unit-per-id/{id}', 'ApiService\v1\ToeisService\Transactions\UnitController@getToggleUnit');
    $router->get('/unit', 'ApiService\v1\ToeisService\Transactions\UnitController@getUnit');
    $router->post('/unit-assignment-toe', 'ApiService\v1\ToeisService\Transactions\UnitController@assignUnitToe');
    $router->get('/unit-task-org', 'ApiService\v1\ToeisService\Transactions\TaskOrganizationController@createTaskOrg');

});