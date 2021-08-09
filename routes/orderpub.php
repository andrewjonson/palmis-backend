<?php

require_once __DIR__ . '/Resource.php';

$router->group(['middleware' => ['jwt', 'verified', 'screenLockDisabled', 'modular:orderpub'], 'prefix' => '/api/'.config('app.version').'/orderpub'], function() use($router) {
    resource('/categories', 'OrderPubService\References\CategoryController', $router);
    resource('/templates', 'OrderPubService\References\TemplateController', $router);
    resource('/types', 'OrderPubService\References\TypeController', $router);
    resource('/appurtenances', 'OrderPubService\References\AppurtenanceController', $router);
    resource('/awards', 'OrderPubService\References\AwardController', $router);
    resource('/awards/type', 'OrderPubService\References\AwardTypeController', $router);
    $router->get('/models', 'ApiService\v1\MpisService\Transactions\ModelListController@index');
    $router->get('/models/type/{id}', 'ApiService\v1\MpisService\Transactions\ModelListController@getModelbyType');
});