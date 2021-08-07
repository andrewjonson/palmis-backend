<?php

require_once __DIR__ . '/Resource.php';

$router->group(['middleware' => ['jwt', 'verified', 'screenLockDisabled', 'modular:mpf'], 'prefix' => '/api/'.config('app.version').'/mpf'], function() use($router) {
    
});