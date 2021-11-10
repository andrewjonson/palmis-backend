<?php

require_once __DIR__ . '/Resource.php';

$router->group(['middleware' => ['auth:api', 'verified', 'screenLockDisabled'], 'prefix' => '/api/'.config('app.version').'/mpis'], function() use($router) {
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
    resource('/rank', 'MpisService\References\RankController', $router);
    resource('/rank-status', 'MpisService\References\RankStatusController', $router);
    resource('/rank-category', 'MpisService\References\RankCategoryController', $router);
    resource('/personnel-group', 'MpisService\References\PersonnelGroupController', $router);
    resource('/civil-status', 'MpisService\References\CivilStatusController', $router);
    resource('/country', 'MpisService\References\CountryController', $router);
    resource('/training', 'MpisService\References\TrainingController', $router);
    resource('/zipcode', 'MpisService\References\ZipcodeController', $router);
    resource('/relationship', 'MpisService\References\RelationshipController', $router);
    resource('/afposmos', 'MpisService\References\AfposmosController', $router);
    resource('/assignment', 'MpisService\References\AssignmentController', $router);
    resource('/language', 'MpisService\References\LanguageController', $router);
    resource('/exam-type', 'MpisService\References\ExamTypeController', $router);
    resource('/bank', 'MpisService\References\BankController', $router);
    resource('/account-type', 'MpisService\References\AccountTypeController', $router);
    resource('/insurance', 'MpisService\References\InsuranceController', $router);
    resource('/insurance-type', 'MpisService\References\InsuranceTypeController', $router);
    resource('/agency', 'MpisService\References\AgencyController', $router);
    resource('/purpose', 'MpisService\References\PurposeController', $router);
    resource('/military-school', 'MpisService\References\MilitarySchoolController', $router);

    $router->get('orderpub-show-pmcode/{pmcode}', 'ApiService\v1\MpisService\Transactions\PersonnelController@getPersonnelDetailByPmcode');
    $router->get('orderpub-pmcode-afposmos/{pmcode}', 'ApiService\v1\MpisService\Transactions\PersonnelController@getPersonnelAfposmosByPmcode');
    $router->post('personnel-id-search', 'ApiService\v1\MpisService\Transactions\PersonnelController@searchPersonnelId');
    $router->get('show-assignment/{id}', 'ApiService\v1\MpisService\Transactions\PersonnelAwardController@getAssignmentById');
    $router->get('show-award-detail/{id}', 'ApiService\v1\MpisService\Transactions\PersonnelAwardController@showAwardDetailById');
    $router->post('create-personnel-enlistment', 'ApiService\v1\MpisService\Transactions\PersonnelEnlistmentController@createPersonnelEnlistment');
    $router->post('create-personnel-reenlistment', 'ApiService\v1\MpisService\Transactions\PersonnelEnlistmentController@createPersonnelReenlistment');
    $router->get('show-personnel-enlistment/{id}', 'ApiService\v1\MpisService\Transactions\PersonnelEnlistmentController@showPersonnelEnlistmentById');
    $router->get('show-order-detail-enlistment/{id}', 'ApiService\v1\MpisService\Transactions\PersonnelEnlistmentController@showPersonnelEnlistmentDetailById');
    $router->post('orderpub-serial-search', 'ApiService\v1\MpisService\Transactions\PersonnelController@searchPersonnelBySerialNumber');
    $router->get('show-afposmos/{id}', 'ApiService\v1\MpisService\References\AfposmosController@getAfposmosById');
    $router->get('dashboard', 'ApiService\v1\MpisService\Transactions\DashboardController@getDashboard');
    $router->get('logs', 'ApiService\v1\MpisService\Transactions\LogController@getLogs');
    $router->post('store-personnel-award', 'ApiService\v1\MpisService\Transactions\PersonnelAwardController@createPersonnelAward');
    $router->get('show-personnel-award/{id}', 'ApiService\v1\MpisService\Transactions\PersonnelAwardController@showPersonnelAward');
    $router->get('get-award-appurtenance', 'ApiService\v1\MpisService\Transactions\PersonnelAwardController@getAppurtenance');
    $router->get('search-personnel-serial', 'ApiService\v1\MpisService\Transactions\PersonnelRankController@searchPersonnelRank');
    $router->post('create-personnel-serial', 'ApiService\v1\MpisService\Transactions\PersonnelRankController@createPersonnelRank');
    $router->get('course-by-level', 'ApiService\v1\MpisService\References\CourseController@getCourseByLevel');
    $router->get('show-personnel-group/{id}', 'ApiService\v1\MpisService\References\PersonnelGroupController@getPersonnelGroupById');
    $router->get('show-civil-status/{id}', 'ApiService\v1\MpisService\References\CivilStatusController@getCivilStatusById');
    $router->get('relationship-search', 'ApiService\v1\MpisService\References\RelationshipController@searchRelationship');
    $router->post('personnel-dynamic-search', 'ApiService\v1\MpisService\Transactions\PersonnelController@dynamicSearchPersonnel');
    $router->post('store-personnel-promotion', 'ApiService\v1\MpisService\Transactions\PersonnelPromotionController@createPersonnelPromotion');
    $router->get('show-personnel-promotion/{id}', 'ApiService\v1\MpisService\Transactions\PersonnelPromotionController@showPersonnelPromotion');
    $router->get('show-order-promotion-detail/{id}', 'ApiService\v1\MpisService\Transactions\PersonnelPromotionController@showOrderPromotionDetail');
    $router->get('search-personnel-rank', 'ApiService\v1\MpisService\References\RankController@searchPersonnelRank');
    $router->get('get-zipcode', 'ApiService\v1\MpisService\References\ZipcodeController@getZipcode');
    $router->get('ethnic-code-search', 'ApiService\v1\MpisService\References\EthnicController@searchEthnic');
    $router->get('personnel-group-search', 'ApiService\v1\MpisService\References\PersonnelGroupController@searchPersonnelGroup');
    $router->get('civil-status-search', 'ApiService\v1\MpisService\References\CitizenshipController@searchCivilStatus');
    $router->get('citizenship-search', 'ApiService\v1\MpisService\References\CitizenshipController@searchCitizenship');
    $router->get('course-type', 'ApiService\v1\MpisService\References\CourseController@getCourseByType');
    $router->post('create-serial', 'ApiService\v1\MpisService\Transactions\SerialNumberController@createSerialNumber');
    $router->post('store-work', 'ApiService\v1\MpisService\Transactions\WorkHistoryController@createWorkHistory');
    $router->put('update-work/{id}', 'ApiService\v1\MpisService\Transactions\WorkHistoryController@updateWorkHistory');
    $router->delete('delete-work/{id}', 'ApiService\v1\MpisService\Transactions\WorkHistoryController@deleteWorkHistory');
    $router->get('work-dynamic-search', 'ApiService\v1\MpisService\Transactions\WorkHistoryController@searchWorkHistory');
    $router->get('show-work/{id}', 'ApiService\v1\MpisService\Transactions\WorkHistoryController@getWorkHistory');
    $router->post('store-social-org', 'ApiService\v1\MpisService\Transactions\SocialOrganizationController@createSocialOrg');
    $router->get('show-social-org/{id}', 'ApiService\v1\MpisService\Transactions\SocialOrganizationController@getSocialOrg');
    $router->post('store-insurance', 'ApiService\v1\MpisService\Transactions\InsuranceController@createInsurance');
    $router->get('show-insurance/{id}', 'ApiService\v1\MpisService\Transactions\InsuranceController@getInsurance');
    $router->post('store-government', 'ApiService\v1\MpisService\Transactions\GovernmentIdController@createGovernmentId');
    $router->get('show-government/{id}', 'ApiService\v1\MpisService\Transactions\GovernmentIdController@getGovernmentId');
    $router->post('store-financial', 'ApiService\v1\MpisService\Transactions\FinancialReferenceController@createFinancialReference');
    $router->get('show-financial/{id}', 'ApiService\v1\MpisService\Transactions\FinancialReferenceController@getFinancialReference');
    $router->post('store-eligibility', 'ApiService\v1\MpisService\Transactions\EligibilityController@createEligibility');
    $router->get('show-eligibility/{id}', 'ApiService\v1\MpisService\Transactions\EligibilityController@getEligibility');
    $router->post('store-country', 'ApiService\v1\MpisService\Transactions\CountryVisitedController@createCountryVisited');
    $router->get('show-country-visited/{id}', 'ApiService\v1\MpisService\Transactions\CountryVisitedController@getCountryVisited');
    $router->post('store-communication', 'ApiService\v1\MpisService\Transactions\CommunicationSkillController@createCommunicationSkill');
    $router->get('show-communication/{id}', 'ApiService\v1\MpisService\Transactions\CommunicationSkillController@getCommunicationSkill');
    $router->post('store-civilian-commendation', 'ApiService\v1\MpisService\Transactions\CivilianCommendationController@createCommendation');
    $router->get('show-civilian-commendation/{id}', 'ApiService\v1\MpisService\Transactions\CivilianCommendationController@getCommendation');
    $router->post('store-reference', 'ApiService\v1\MpisService\Transactions\CharacterReferenceController@createReference');
    $router->put('update-reference/{id}', 'ApiService\v1\MpisService\Transactions\CharacterReferenceController@updateReference');
    $router->delete('delete-reference/{id}', 'ApiService\v1\MpisService\Transactions\CharacterReferenceController@deleteReference');
    $router->get('show-reference/{id}', 'ApiService\v1\MpisService\Transactions\CharacterReferenceController@getReference');
    $router->get('show-tariff-size/{id}', 'ApiService\v1\MpisService\Transactions\TarrifSizeController@getTarrifSizeById');
    $router->post('store-tariff-size', 'ApiService\v1\MpisService\Transactions\TarrifSizeController@createTarrifSize');
    $router->get('show-characteristic/{id}', 'ApiService\v1\MpisService\Transactions\PersonalCharacteristicController@getPersonalCharacteristicById');
    $router->post('store-characteristic', 'ApiService\v1\MpisService\Transactions\PersonalCharacteristicController@createPersonalCharacteristic');
    $router->get('show-family/{id}', 'ApiService\v1\MpisService\Transactions\FamilyHistoryController@showFamilyHistoryById');
    $router->post('store-family', 'ApiService\v1\MpisService\Transactions\FamilyHistoryController@createFamilyHistory');
    $router->put('update-family/{id}', 'ApiService\v1\MpisService\Transactions\FamilyHistoryController@updateFamilyHistory');
    $router->delete('delete-family/{id}', 'ApiService\v1\MpisService\Transactions\FamilyHistoryController@deleteFamily');
    $router->get('show-education/{id}', 'ApiService\v1\MpisService\References\EducationalBackgroundController@getPersonnelEducationBackground');
    $router->post('store-education', 'ApiService\v1\MpisService\References\EducationalBackgroundController@createPersonnelEducationBackground');
    $router->put('update-education/{id}', 'ApiService\v1\MpisService\References\EducationalBackgroundController@updatePersonnelEducationBackground');
    $router->get('get-province', 'ApiService\v1\MpisService\References\ProvinceController@getProvince');
    $router->get('get-municity', 'ApiService\v1\MpisService\References\MuniCityController@getMunicity');
    $router->get('get-barangay', 'ApiService\v1\MpisService\References\BarangayController@getBarangay');
    $router->get('show-municity/{id}', 'ApiService\v1\MpisService\References\MuniCityController@getMunicityById');
    $router->get('show-province/{id}', 'ApiService\v1\MpisService\References\ProvinceController@getProvinceById');
    $router->get('show-barangay/{id}', 'ApiService\v1\MpisService\References\BarangayController@getBarangayById');
    $router->post('create-personnel-rank', 'ApiService\v1\MpisService\Transactions\PersonnelController@createPersonnelRank');
    $router->post('create-personnel-unit', 'ApiService\v1\MpisService\Transactions\PersonnelController@createPersonnelUnit');
    $router->post('store-address', 'ApiService\v1\MpisService\Transactions\PersonnelController@createPersonnelAddress');
    $router->get('show-address/{id}', 'ApiService\v1\MpisService\Transactions\PersonnelController@getPersonnelAddress');
    $router->put('update-address/{id}', 'ApiService\v1\MpisService\Transactions\PersonnelController@updatePersonnelAddress');
    $router->post('personnel-search', 'ApiService\v1\MpisService\Transactions\PersonnelController@searchPersonnel');
    $router->get('show-personnel/{id}', 'ApiService\v1\MpisService\Transactions\PersonnelController@getPersonnelById');
    $router->get('personnel-total', 'ApiService\v1\MpisService\Transactions\PersonnelController@countPersonnel');
    $router->post('search-info', 'ApiService\v1\MpisService\Transactions\PersonnelController@advanceSearchPersonnel');
    $router->get('show-pmcode/{id}', 'ApiService\v1\MpisService\Transactions\PersonnelController@getPersonnelByPmcode');
    $router->post('upload-image', 'ApiService\v1\MpisService\Transactions\PersonnelController@uploadPersonnelImage');
    $router->post('search-serial', 'ApiService\v1\MpisService\Transactions\PersonnelController@searchPersonnelBySerial');
    $router->post('create-personnel', 'ApiService\v1\MpisService\Transactions\PersonnelController@createPersonnel');
    $router->put('update-personnel/{id}', 'ApiService\v1\MpisService\Transactions\PersonnelController@updatePersonnel');
    $router->get('show-rank/{id}', 'ApiService\v1\MpisService\References\RankController@getRankById');
    $router->get('show-training/{id}', 'ApiService\v1\MpisService\References\TrainingController@getTrainingById');
    $router->get('show-personnel-type/{id}', 'ApiService\v1\MpisService\References\PersonnelTypeController@getPersonnelTypeById');
    $router->post('store-insurance', 'ApiService\v1\MpisService\Transactions\InsuranceRecordController@storeInsurance');
    $router->get('show-insurance/{id}', 'ApiService\v1\MpisService\Transactions\InsuranceRecordController@showInsurance');
    $router->put('update-insurance/{id}', 'ApiService\v1\MpisService\Transactions\InsuranceRecordController@updateInsurance');
    $router->put('delete-insurance/{id}', 'ApiService\v1\MpisService\Transactions\InsuranceRecordController@deleteInsurance');
    $router->get('insurance-dynamic-search', 'ApiService\v1\MpisService\Transactions\InsuranceRecordController@searchInsurance');
    $router->post('store-reference', 'ApiService\v1\MpisService\Transactions\CharacterReferenceController@createReference');
    $router->get('show-reference/{id}', 'ApiService\v1\MpisService\Transactions\CharacterReferenceController@getReference');
    $router->put('update-reference/{id}', 'ApiService\v1\MpisService\Transactions\CharacterReferenceController@updateReference');
    $router->put('delete-reference/{id}', 'ApiService\v1\MpisService\Transactions\CharacterReferenceController@deleteReference');
    $router->get('reference-dynamic-search', 'ApiService\v1\MpisService\Transactions\CharacterReferenceController@searchReference');
    $router->put('update-eligiblity/{id}', 'ApiService\v1\MpisService\Transactions\EligibilityController@updateEligibility');
    $router->delete('delete-eligiblity/{id}', 'ApiService\v1\MpisService\Transactions\EligibilityController@deleteEligibility');
    $router->put('update-communication/{id}', 'ApiService\v1\MpisService\Transactions\CommunicationSkillController@updateCommunication');
    $router->delete('delete-communication/{id}', 'ApiService\v1\MpisService\Transactions\CommunicationSkillController@deleteCommunication');
    $router->put('update-financial/{id}', 'ApiService\v1\MpisService\Transactions\FinancialReferenceController@updateFinancial');
    $router->delete('delete-financial/{id}', 'ApiService\v1\MpisService\Transactions\FinancialReferenceController@deleteFinancial');
    $router->put('update-social-org/{id}', 'ApiService\v1\MpisService\Transactions\SocialOrganizationController@updateSocialOrg');
    $router->delete('delete-social-org/{id}', 'ApiService\v1\MpisService\Transactions\SocialOrganizationController@deleteSocialOrg');
    $router->post('store-personnel-unit-assignment', 'ApiService\v1\MpisService\Transactions\PersonnelUnitController@createPersonnelUnit');
    $router->get('personnel-soi', 'ApiService\v1\MpisService\Transactions\PersonnelController@getPeronnelSoiByPmcode');
    $router->get('orderpub-personnel-trainee', 'ApiService\v1\MpisService\Transactions\PersonnelController@getPersonnelTrainee');
    $router->post('store-personnel-duty-assignment', 'ApiService\v1\MpisService\Transactions\PersonnelDutyAssignmentController@createDutyAssignment');
    $router->get('show-personnel-duty-assignment/{id}', 'ApiService\v1\MpisService\Transactions\PersonnelDutyAssignmentController@showDutyAssignmentById');
    $router->get('show-order-duty-assignment-detail/{id}', 'ApiService\v1\MpisService\Transactions\PersonnelDutyAssignmentController@showDutyAssignmentDetailById');
    $router->post('store-personnel-unit-assignment', 'ApiService\v1\MpisService\Transactions\PersonnelUnitAssignmentController@createUnitAssignment');
    $router->get('show-personnel-unit-assignment/{id}', 'ApiService\v1\MpisService\Transactions\PersonnelUnitAssignmentController@showUnitAssignmentById');
    $router->get('show-order-unit-assignment-detail/{id}', 'ApiService\v1\MpisService\Transactions\PersonnelUnitAssignmentController@showUnitAssignmentDetailById');
});