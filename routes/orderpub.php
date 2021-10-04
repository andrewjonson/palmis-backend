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
    resource('/originating-offices', 'OrderPubService\References\OriginatingOfficeController', $router);


    $router->put('/statuses/{id}', 'ApiService\v1\OrderPubService\References\StatusController@update');
    $router->get('/show-status', 'ApiService\v1\OrderPubService\References\StatusController@getStatusById');
    $router->get('/authority/{office}', 'ApiService\v1\OrderPubService\References\AuthorityLineController@getAuthorityLine');
    $router->get('/types/category/{id}', 'ApiService\v1\OrderPubService\References\TypeController@getTypeByCategory');
    $router->get('/types/{id}', 'ApiService\v1\OrderPubService\References\TypeController@getTypeById');
    $router->get('/types/model/{id}', 'ApiService\v1\OrderPubService\References\TypeController@getModelByType');
    $router->get('/types/template/{id}', 'ApiService\v1\OrderPubService\References\TypeController@getTypeWithTemplates');
    $router->get('/models', 'ApiService\v1\OrderPubService\References\ModelListController@index');
    $router->get('/models/type/{id}', 'ApiService\v1\OrderPubService\References\ModelListController@getModelbyType');

    //Document Setting
    $router->get('/document-setting', 'ApiService\v1\OrderPubService\References\DocumentSettingController@getDocumentSetting');
    $router->post('/update-document-setting/{id}', 'ApiService\v1\OrderPubService\References\DocumentSettingController@updatetDocumentSetting');
    $router->post('/document-setting', 'ApiService\v1\OrderPubService\References\DocumentSettingController@storeDocumentSetting');

    //File Directory
    $router->get('/directories', 'ApiService\v1\OrderPubService\Transactions\FileDirectoryController@getDirectories');
    $router->post('/directories/folders', 'ApiService\v1\OrderPubService\Transactions\FileDirectoryController@createFolder');
    $router->put('/directories/{id}', 'ApiService\v1\OrderPubService\Transactions\FileDirectoryController@updateFolder');
    $router->get('/directories/show-folders', 'ApiService\v1\OrderPubService\Transactions\FileDirectoryController@showFolders');
    $router->get('/directories/contents', 'ApiService\v1\OrderPubService\Transactions\FileDirectoryController@showFolderContents');
    $router->delete('/directories/{id}', 'ApiService\v1\OrderPubService\Transactions\FileDirectoryController@deleteContent');
    $router->put('/directories/restore/{id}', 'ApiService\v1\OrderPubService\Transactions\FileDirectoryController@restoreFolder');
    $router->get('/directories/only-trashed', 'ApiService\v1\OrderPubService\Transactions\FileDirectoryController@showFolderTrashed');

    //Folder
    $router->get('/folders/content', 'ApiService\v1\OrderPubService\Transactions\FolderController@getFolderContent');
    $router->get('/folders/categories', 'ApiService\v1\OrderPubService\Transactions\FolderController@getFolderbyCategory');
    $router->get('/folders', 'ApiService\v1\OrderPubService\Transactions\FolderController@getFolder');
    $router->get('/folders/templates/{id}', 'ApiService\v1\OrderPubService\Transactions\FolderController@getFolderWithTemplate');
    $router->post('/folders', 'ApiService\v1\OrderPubService\Transactions\FolderController@createFolder');
    $router->post('/folders/{id}', 'ApiService\v1\OrderPubService\Transactions\FolderController@createSubFolder');
    $router->post('/folders/store-templates/{id}', 'ApiService\v1\OrderPubService\Transactions\FolderController@storeTemplateToFolder');
    $router->put('/folders/{id}', 'ApiService\v1\OrderPubService\Transactions\FolderController@updateFolder');

    //Order
    $router->get('/orders', 'ApiService\v1\OrderPubService\Transactions\OrderController@getOrders');
    $router->delete('/order/{id}', 'ApiService\v1\OrderPubService\Transactions\OrderController@destroy');
    $router->delete('/order/force-delete/{id}', 'ApiService\v1\OrderPubService\Transactions\OrderController@forceDelete');
    $router->get('/order/only-trashed', 'ApiService\v1\OrderPubService\Transactions\OrderController@onlyTrashed');
    $router->put('/order/restore/{id}', 'ApiService\v1\OrderPubService\Transactions\OrderController@restore');

    $router->get('/order-histories/{id}', 'ApiService\v1\OrderPubService\Transactions\OrderController@getOrderHistories');
    $router->get('/order-drafts', 'ApiService\v1\OrderPubService\Transactions\OrderController@getDraftOrders');
    $router->get('/published-orders', 'ApiService\v1\OrderPubService\Transactions\OrderController@getPublishedOrders');
    $router->post('/orders/templates/{id}', 'ApiService\v1\OrderPubService\Transactions\OrderController@saveOrderAsTemplate');
    $router->post('/general-order/{id}', 'ApiService\v1\OrderPubService\Transactions\OrderController@createGeneralOrder');
    $router->put('/revise-general-order/{id}', 'ApiService\v1\OrderPubService\Transactions\OrderController@reviseGeneralOrder');
    $router->put('/publish-order/{id}', 'ApiService\v1\OrderPubService\Transactions\OrderController@publishOrder');
    $router->get('/order/{id}', 'ApiService\v1\OrderPubService\Transactions\OrderController@viewPublishOrder');
    $router->get('/view-order/{versionId}', 'ApiService\v1\OrderPubService\Transactions\OrderController@viewDraftOrder');

    //Order Route
    $router->post('/route-order/{id}', 'ApiService\v1\OrderPubService\Transactions\OrderRouteController@routeOrder');
    $router->get('/order-route/{id}', 'ApiService\v1\OrderPubService\Transactions\OrderRouteController@showOrderRoute');
    $router->put('/update-route/{id}', 'ApiService\v1\OrderPubService\Transactions\OrderRouteController@saveRemarks');

});