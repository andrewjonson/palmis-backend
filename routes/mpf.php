<?php

require_once __DIR__ . '/Resource.php';

$router->group(['middleware' => ['jwt', 'verified', 'screenLockDisabled', 'modular:mpf'], 'prefix' => '/api/'.config('app.version').'/mpf'], function() use($router) {
    resource('/folders', 'MpfService\References\FolderController', $router);
    $router->get('/personnels/folder/{pmcode}', 'ApiService\v1\MpfService\Transactions\PersonnelFolderController@getPersonnelFolderByPmcode');
    $router->get('/personnels/folders/{pmcode}', 'ApiService\v1\MpfService\Transactions\PersonnelFolderController@getPersonnelFolders');
    $router->post('/personnels/folder', 'ApiService\v1\MpfService\Transactions\PersonnelFolderController@createPersonnelFolder');
    $router->post('/tab-attachments/upload/{tabId}', 'ApiService\v1\MpfService\Transactions\UploadAttachmentController@uploadTabAttachment');
    $router->post('/sub-tab-attachments/upload/{subTabId}', 'ApiService\v1\MpfService\Transactions\UploadAttachmentController@uploadSubTabAttachment');
});