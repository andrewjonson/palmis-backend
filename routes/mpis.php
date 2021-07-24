<?php

require_once __DIR__ . '/Resource.php';

$router->group(['middleware' => ['jwt', 'verified', 'screenLockDisabled', 'modular:mpis'], 'prefix' => '/api/'.config('app.version').'/mpis'], function() use($router) {
    resource('/personnels', 'MpisService\Transactions\PersonnelController', $router);
});