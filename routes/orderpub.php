<?php

require_once __DIR__ . '/Resource.php';

$router->group(['middleware' => ['jwt', 'verified', 'screenLockDisabled', 'modular:orderpub'], 'prefix' => '/api/'.config('app.version').'/orderpub'], function() use($router) {
    resource('/categories', 'OrderPubService\References\CategoryController', $router);
    resource('/templates', 'OrderPubService\References\TemplateController', $router);
    resource('/types', 'OrderPubService\References\TypeController', $router);
    $router->get('/types/category/{id}', 'ApiService\v1\OrderPubService\References\TypeController@getTypeByCategory');
    $router->get('/types/model/{id}', 'ApiService\v1\OrderPubService\References\TypeController@getTypeById');
    resource('/appurtenances', 'OrderPubService\References\AppurtenanceController', $router);
    resource('/awards', 'OrderPubService\References\AwardController', $router);
    resource('/awards/type', 'OrderPubService\References\AwardTypeController', $router);
    $router->get('/models', 'ApiService\v1\OrderPubService\References\ModelListController@index');
    $router->get('/models/type/{id}', 'ApiService\v1\OrderPubService\References\ModelListController@getModelbyType');
    $router->get('/document-setting', 'ApiService\v1\OrderPubService\References\DocumentSettingController@getDocumentSetting');
    $router->post('/update-document-setting/{id}', 'ApiService\v1\OrderPubService\References\DocumentSettingController@updatetDocumentSetting');
    $router->post('/document-setting', 'ApiService\v1\OrderPubService\References\DocumentSettingController@storeDocumentSetting');
    $router->get('/orders', 'ApiService\v1\OrderPubService\Transactions\OrderController@getOrders');
    $router->get('/general-order/{id}', 'ApiService\v1\OrderPubService\Transactions\OrderController@createGeneralOrder');
    $router->get('/signatories', 'ApiService\v1\OrderPubService\References\DocumentSettingSignatoryController@index');
    $router->post('/signatory', 'ApiService\v1\OrderPubService\References\DocumentSettingSignatoryController@store');
    $router->put('/signatory/{id}', 'ApiService\v1\OrderPubService\References\DocumentSettingSignatoryController@update');
    $router->delete('/signatory/{id}', 'ApiService\v1\OrderPubService\References\DocumentSettingSignatoryController@destroy');
    $router->get('/signatories-trashed', 'ApiService\v1\OrderPubService\References\DocumentSettingSignatoryController@onlyTrashed');
    $router->put('/signatory-restore/{id}', 'ApiService\v1\OrderPubService\References\DocumentSettingSignatoryController@restore');
});