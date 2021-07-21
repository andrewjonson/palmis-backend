<?php

require_once __DIR__ . '/Resource.php';

$router->group(['middleware' => ['jwt', 'verified', 'screenLockDisabled'], 'prefix' => '/api/'.config('app.version').'/mpf'], function() use($router) {
    resource('/groups', 'MpfService\References\GroupController', $router);
    resource('/main-categories', 'MpfService\References\MainCategoryController', $router);
    resource('/sub-categories', 'MpfService\References\SubCategoryController', $router);
    resource('/profiles/main', 'MpfService\Transactions\MpfController', $router);

    $router->get('/personnels/profiles/{id}', 'ApiService\v1\MpfService\Transactions\PersonnelProfileController@getProfile');
    $router->post('/personnels/profiles/add', 'ApiService\v1\MpfService\Transactions\PersonnelProfileController@addProfile');
    $router->get('/profiles/sub/{id}', 'ApiService\v1\MpfService\Transactions\SubController@getSub');
    $router->post('/profiles/sub', 'ApiService\v1\MpfService\Transactions\SubController@createSub');
    $router->get('/tabs/{id}', 'ApiService\v1\MpfService\References\TabController@getTab');
});