<?php

$router->group(['middleware' => ['jwt', 'verified', 'screenLockDisabled'], 'prefix' => '/api/'.config('app.version').'/mpf'], function() use($router) {
    $router->get('/groups', 'ApiServiceControllers\v1\MpfService\References\GroupController@index');
    $router->post('/groups', 'ApiServiceControllers\v1\MpfService\References\GroupController@store');
    $router->put('/groups/{id}', 'ApiServiceControllers\v1\MpfService\References\GroupController@update');
    $router->delete('/groups/{id}', 'ApiServiceControllers\v1\MpfService\References\GroupController@delete');
    $router->get('/groups/only-trashed', 'ApiServiceControllers\v1\MpfService\References\GroupController@onlyTrashed');
    $router->put('/groups/restore/{id}', 'ApiServiceControllers\v1\MpfService\References\GroupController@restore');
    $router->delete('/groups/force-delete/{id}', 'ApiServiceControllers\v1\MpfService\References\GroupController@forceDelete');

    $router->get('/main-categories', 'ApiServiceControllers\v1\MpfService\References\MainCategoryController@index');
    $router->post('/main-categories', 'ApiServiceControllers\v1\MpfService\References\MainCategoryController@store');
    $router->put('/main-categories/{id}', 'ApiServiceControllers\v1\MpfService\References\MainCategoryController@update');
    $router->delete('/main-categories/{id}', 'ApiServiceControllers\v1\MpfService\References\MainCategoryController@delete');
    $router->get('/main-categories/only-trashed', 'ApiServiceControllers\v1\MpfService\References\MainCategoryController@onlyTrashed');
    $router->put('/main-categories/restore/{id}', 'ApiServiceControllers\v1\MpfService\References\MainCategoryController@restore');
    $router->delete('/main-categories/force-delete/{id}', 'ApiServiceControllers\v1\MpfService\References\MainCategoryController@forceDelete');

    $router->get('/sub-categories', 'ApiServiceControllers\v1\MpfService\References\SubCategoryController@index');
    $router->post('/sub-categories', 'ApiServiceControllers\v1\MpfService\References\SubCategoryController@store');
    $router->put('/sub-categories/{id}', 'ApiServiceControllers\v1\MpfService\References\SubCategoryController@update');
    $router->delete('/sub-categories/{id}', 'ApiServiceControllers\v1\MpfService\References\SubCategoryController@delete');
    $router->get('/sub-categories/only-trashed', 'ApiServiceControllers\v1\MpfService\References\SubCategoryController@onlyTrashed');
    $router->put('/sub-categories/restore/{id}', 'ApiServiceControllers\v1\MpfService\References\SubCategoryController@restore');
    $router->delete('/sub-categories/force-delete/{id}', 'ApiServiceControllers\v1\MpfService\References\SubCategoryController@forceDelete');
});