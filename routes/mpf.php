<?php

require_once __DIR__ . '/Resource.php';

$router->group(['middleware' => ['auth:api', 'verified', 'screenLockDisabled', 'modular:mpf'], 'prefix' => '/api/'.config('app.version').'/mpf'], function() use($router) {
    resource('/folders', 'MpfService\References\FolderController', $router);
    $router->get('/personnels/folder/{pmcode}', 'ApiService\v1\MpfService\Transactions\PersonnelFolderController@getPersonnelFolderByPmcode');
    $router->get('/personnels/folders', 'ApiService\v1\MpfService\Transactions\PersonnelFolderController@getFolders');
    $router->post('/personnels/folder', 'ApiService\v1\MpfService\Transactions\PersonnelFolderController@createPersonnelFolder');
    $router->post('/tab-attachments/upload/{tabId}', 'ApiService\v1\MpfService\Transactions\UploadAttachmentController@uploadTabAttachment');
    $router->post('/sub-tab-attachments/upload/{subTabId}', 'ApiService\v1\MpfService\Transactions\UploadAttachmentController@uploadSubTabAttachment');
    $router->get('/personnels/personnel-folders/{pmcode}', 'ApiService\v1\MpfService\Transactions\PersonnelFolderController@getPersonnelFolders');
    $router->post('/personnels/folder/sync', 'ApiService\v1\MpfService\Transactions\PersonnelFolderController@syncPersonnelFolder');
    $router->delete('/tab-attachments/delete/{id}', 'ApiService\v1\MpfService\Transactions\UploadAttachmentController@deleteTabAttachment');
    $router->delete('/sub-tab-attachments/delete/{id}', 'ApiService\v1\MpfService\Transactions\UploadAttachmentController@deleteSubTabAttachment');

    resource('/documenttypes', 'MpfService\References\DocumentTypeController', $router);
    $router->post('/personnel-documents/upload/{pmcode}', 'ApiService\v1\MpfService\Transactions\PersonnelDocumentController@upload');
    $router->get('/personnel-documents/{pmcode}', 'ApiService\v1\MpfService\Transactions\PersonnelDocumentController@getPersonnelDocuments');
    $router->delete('/personnel-documents/{id}', 'ApiService\v1\MpfService\Transactions\PersonnelDocumentController@deletePersonnelDocument');
});