<?php

require_once __DIR__ . '/Resource.php';

$router->group(['middleware' => ['jwt', 'verified', 'screenLockDisabled', 'modular:mpis'], 'prefix' => '/api/'.config('app.version').'/mpis'], function() use($router) {
    resource('/personnels', 'MpisService\Transactions\PersonnelController', $router);
    $router->post('personnel-search', 'ApiService\v1\MpisService\Transactions\PersonnelController@searchPersonnel');
    $router->get('show-personnel/{id}', 'ApiService\v1\MpisService\Transactions\PersonnelController@getPersonnelById');
    $router->post('search-info', 'ApiService\v1\MpisService\Transactions\PersonnelController@advanceSearchPersonnel');
    $router->get('show-pmcode/{id}', 'ApiService\v1\MpisService\Transactions\PersonnelController@getPersonnelByPmcode');
    $router->post('upload-image', 'ApiService\v1\MpisService\Transactions\PersonnelController@uploadPersonnelImage');
    $router->post('search-serial-birth', 'ApiService\v1\MpisService\Transactions\PersonnelController@searchPersonnelBySerialNumberBirthdate');
    $router->post('search-serial', 'ApiService\v1\MpisService\Transactions\PersonnelController@searchPersonnelBySerial');

});