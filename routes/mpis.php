<?php

$router->group(['middleware' => ['jwt', 'verified', 'screenLockDisabled'], 'prefix' => '/api/'.config('app.version').'/mpis'], function() use($router) {
    $router->get('/personnels', 'ApiServiceControllers\v1\MpisService\Transactions\PersonnelController@index');
    $router->post('/personnels', 'ApiServiceControllers\v1\MpisService\Transactions\PersonnelController@store');
    $router->put('/personnels/{id}', 'ApiServiceControllers\v1\MpisService\Transactions\PersonnelController@update');
    $router->delete('/personnels/{id}', 'ApiServiceControllers\v1\MpisService\Transactions\PersonnelController@delete');
    $router->get('/personnels/only-trashed', 'ApiServiceControllers\v1\MpisService\Transactions\PersonnelController@onlyTrashed');
    $router->put('/personnels/restore/{id}', 'ApiServiceControllers\v1\MpisService\Transactions\PersonnelController@restore');
    $router->delete('/personnels/force-delete/{id}', 'ApiServiceControllers\v1\MpisService\Transactions\PersonnelController@forceDelete');
    $router->get('/personnels/profiles', 'ApiServiceControllers\v1\MpisService\Transactions\PersonnelController@profiles');
    $router->post('/personnels/profiles/add', 'ApiServiceControllers\v1\MpisService\Transactions\PersonnelController@addProfile');
});