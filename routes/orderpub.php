<?php

require_once __DIR__ . '/Resource.php';

$router->group(['middleware' => ['auth:api', 'verified', 'screenLockDisabled', 'modular:orderpub'], 'prefix' => '/api/'.config('app.version').'/orderpub'], function() use($router) {
    resource('/categories', 'OrderPubService\References\CategoryController', $router);
    resource('/templates', 'OrderPubService\References\TemplateController', $router);
    resource('/types', 'OrderPubService\References\TypeController', $router);
    resource('/appurtenances', 'OrderPubService\References\AppurtenanceController', $router);
    resource('/awards', 'OrderPubService\References\AwardController', $router);
    resource('/awards/type', 'OrderPubService\References\AwardTypeController', $router);
    resource('/authoritylines', 'OrderPubService\References\AuthorityLineController', $router);
    resource('/signatories', 'OrderPubService\References\DocumentSettingSignatoryController', $router);

    $router->get('/statuses', 'ApiService\v1\OrderPubService\References\StatusController@index');
    $router->put('/statuses/{id}', 'ApiService\v1\OrderPubService\References\StatusController@update');
    $router->get('/show-status', 'ApiService\v1\OrderPubService\References\StatusController@getStatusById');
    $router->get('/authority/{office}', 'ApiService\v1\OrderPubService\References\AuthorityLineController@getAuthorityLine');
    $router->get('/folders/content', 'ApiService\v1\OrderPubService\Transactions\FolderController@getFolderContent');
    $router->get('/folders/categories', 'ApiService\v1\OrderPubService\Transactions\FolderController@getFolderbyCategory');
    $router->get('/folders', 'ApiService\v1\OrderPubService\Transactions\FolderController@getFolder');
    $router->get('/folders/templates/{id}', 'ApiService\v1\OrderPubService\Transactions\FolderController@getFolderWithTemplate');
    $router->post('/folders', 'ApiService\v1\OrderPubService\Transactions\FolderController@createFolder');
    $router->post('/folders/{id}', 'ApiService\v1\OrderPubService\Transactions\FolderController@createSubFolder');
    $router->post('/folders/store-templates/{id}', 'ApiService\v1\OrderPubService\Transactions\FolderController@storeTemplateToFolder');
    $router->put('/folders/{id}', 'ApiService\v1\OrderPubService\Transactions\FolderController@updateFolder');
    $router->get('/types/category/{id}', 'ApiService\v1\OrderPubService\References\TypeController@getTypeByCategory');
    $router->get('/types/model/{id}', 'ApiService\v1\OrderPubService\References\TypeController@getTypeById');
    $router->get('/types/template/{id}', 'ApiService\v1\OrderPubService\References\TypeController@getTypeWithTemplates');
    $router->get('/models', 'ApiService\v1\OrderPubService\References\ModelListController@index');
    $router->get('/models/type/{id}', 'ApiService\v1\OrderPubService\References\ModelListController@getModelbyType');
    $router->get('/document-setting', 'ApiService\v1\OrderPubService\References\DocumentSettingController@getDocumentSetting');
    $router->post('/update-document-setting/{id}', 'ApiService\v1\OrderPubService\References\DocumentSettingController@updatetDocumentSetting');
    $router->post('/document-setting', 'ApiService\v1\OrderPubService\References\DocumentSettingController@storeDocumentSetting');
    $router->get('/orders', 'ApiService\v1\OrderPubService\Transactions\OrderController@getOrders');
    $router->get('/order-histories/{id}', 'ApiService\v1\OrderPubService\Transactions\OrderController@getOrderHistories');
    $router->get('/order-drafts', 'ApiService\v1\OrderPubService\Transactions\OrderController@getDraftOrders');
    $router->get('/published-orders', 'ApiService\v1\OrderPubService\Transactions\OrderController@getPublishedOrders');
    $router->post('/orders/templates/{id}', 'ApiService\v1\OrderPubService\Transactions\OrderController@saveOrderAsTemplate');
    $router->post('/general-order/{id}', 'ApiService\v1\OrderPubService\Transactions\OrderController@createGeneralOrder');
    $router->put('/revise-general-order/{id}', 'ApiService\v1\OrderPubService\Transactions\OrderController@reviseGeneralOrder');
    $router->put('/publish-order/{id}', 'ApiService\v1\OrderPubService\Transactions\OrderController@publishOrder');
    $router->get('/view-order/{id}', 'ApiService\v1\OrderPubService\Transactions\OrderController@viewPublishOrder');
    $router->get('/view-draft-order/{id}', 'ApiService\v1\OrderPubService\Transactions\OrderController@viewDraftOrder');
    $router->post('/route-order/{id}', 'ApiService\v1\OrderPubService\Transactions\OrderRouteController@routeOrder');
    $router->post('/update-route/{id}', 'ApiService\v1\OrderPubService\Transactions\OrderRouteController@saveRemarks');
    $router->post('/show-status/{id}', 'ApiService\v1\OrderPubService\Transactions\OrderRouteController@saveRemarks');
});