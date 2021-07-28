<?php

require_once __DIR__ . '/Resource.php';

$router->group(['middleware' => ['jwt', 'verified', 'screenLockDisabled', 'modular:orderpub'], 'prefix' => '/api/'.config('app.version').'/orderpub'], function() use($router) {
    resource('/categories', 'OrderPubService\References\CategoryController', $router);
    resource('/templates', 'OrderPubService\References\TemplateController', $router);
    resource('/types', 'OrderPubService\References\TypeController', $router);
});