<?php

require_once __DIR__ . '/Resource.php';

$router->group(['middleware' => ['jwt', 'verified', 'screenLockDisabled', 'modular:mpis'], 'prefix' => '/api/'.config('app.version').'/mpis'], function() use($router) {
    resource('/personnels', 'MpisService\Transactions\PersonnelController', $router);
    resource('/barangay', 'MpisService\References\BarangayController', $router);
    resource('/bda-size', 'MpisService\References\BdaSizeController', $router);
    resource('/built', 'MpisService\References\BuiltController', $router);
    resource('/citizenship', 'MpisService\References\CitizenshipController', $router);
    resource('/municity', 'MpisService\References\MuniCityController', $router);
    resource('/course', 'MpisService\References\CourseController', $router);
    resource('/education-level', 'MpisService\References\EducationLevelController', $router);
    resource('/ethnic', 'MpisService\References\EthnicController', $router);
    resource('/eye-color', 'MpisService\References\EyeColorController', $router);
    resource('/hair-color', 'MpisService\References\HairColorController', $router);
    resource('/hair-type', 'MpisService\References\HairTypeController', $router);
    resource('/region', 'MpisService\References\RegionController', $router);
    resource('/province', 'MpisService\References\ProvinceController', $router);
    resource('/religion', 'MpisService\References\ReligionController', $router);
    resource('/school', 'MpisService\References\SchoolController', $router);
    resource('/personnel-type', 'MpisService\References\PersonnelTypeController', $router);
    resource('/branch-of-service', 'MpisService\References\BranchOfServiceController', $router);
    resource('/rank-status', 'MpisService\References\RankStatusController', $router);
    resource('/rank-category', 'MpisService\References\RankCategoryController', $router);
    resource('/personnel-group', 'MpisService\References\PersonnelGroupController', $router);
    resource('/civil-status', 'MpisService\References\CivilStatusController', $router);

    $router->get('show-tariff-size/{id}', 'ApiService\v1\MpisService\Transactions\TarrifSizeController@getTarrifSizeById');
    $router->post('store-tariff-size', 'ApiService\v1\MpisService\Transactions\TarrifSizeController@createTarrifSize');
    $router->get('show-characteristic/{id}', 'ApiService\v1\MpisService\References\PersonalCharacteristicController@getPersonalCharacteristicById');
    $router->post('store-characteristic', 'ApiService\v1\MpisService\References\PersonalCharacteristicController@createPersonalCharacteristic');
    $router->get('show-family/{id}', 'ApiService\v1\MpisService\Transactions\FamilyHistoryController@showFamilyHistoryById');
    $router->post('store-family', 'ApiService\v1\MpisService\Transactions\FamilyHistoryController@createFamilyHistory');
    $router->put('update-family/{id}', 'ApiService\v1\MpisService\Transactions\FamilyHistoryController@updateFamilyHistory');
    $router->delete('delete-family/{id}', 'ApiService\v1\MpisService\Transactions\FamilyHistoryController@deleteFamily');
    $router->post('show-education/{id}', 'ApiService\v1\MpisService\Transactions\EducationalBackgroundController@getPersonnelEducationBackground');
    $router->get('store-education', 'ApiService\v1\MpisService\References\EducationalBackgroundController@createPersonnelEducationBackground');
    $router->put('update-education/{id}', 'ApiService\v1\MpisService\References\EducationalBackgroundController@updatePersonnelEducationBackground');
    $router->get('get-province', 'ApiService\v1\MpisService\References\ProvinceController@getProvince');
    $router->get('get-municity', 'ApiService\v1\MpisService\References\MuniCityController@getMunicity');
    $router->get('get-barangay', 'ApiService\v1\MpisService\References\BarangayController@getBarangay');
    $router->post('create-personnel-rank', 'ApiService\v1\MpisService\Transactions\PersonnelController@createPersonnelRank');
    $router->post('create-personnel-unit', 'ApiService\v1\MpisService\Transactions\PersonnelController@createPersonnelUnit');
    $router->post('store-address', 'ApiService\v1\MpisService\Transactions\PersonnelController@createPersonnelAddress');
    $router->get('show-address/{id}', 'ApiService\v1\MpisService\References\BarangayController@getPersonnelAddress');
    $router->put('update-address/{id}', 'ApiService\v1\MpisService\References\BarangayController@updatePersonnelAddress');
    $router->post('personnel-search', 'ApiService\v1\MpisService\Transactions\PersonnelController@searchPersonnel');
    $router->get('show-personnel/{id}', 'ApiService\v1\MpisService\Transactions\PersonnelController@getPersonnelById');
    $router->post('search-info', 'ApiService\v1\MpisService\Transactions\PersonnelController@advanceSearchPersonnel');
    $router->get('show-pmcode/{id}', 'ApiService\v1\MpisService\Transactions\PersonnelController@getPersonnelByPmcode');
    $router->post('upload-image', 'ApiService\v1\MpisService\Transactions\PersonnelController@uploadPersonnelImage');
    $router->post('search-serial-birth', 'ApiService\v1\MpisService\Transactions\PersonnelController@searchPersonnelBySerialNumberBirthdate');
    $router->post('search-serial', 'ApiService\v1\MpisService\Transactions\PersonnelController@searchPersonnelBySerial');
    $router->post('create-personnel', 'ApiService\v1\MpisService\Transactions\PersonnelController@createPersonnel');
});