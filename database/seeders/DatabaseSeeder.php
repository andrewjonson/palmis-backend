<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\DatabaseSeeder;
use Database\Seeders\RolesTableSeeder;
use Database\Seeders\TeamsTableSeeder;
use Database\Seeders\UsersTableSeeder;
use Database\Seeders\ModulesTableSeeder;
use Database\Seeders\SettingsTableSeeder;
use Database\Seeders\ApiService\v1\CmisService\References\QrsPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\References\BankPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\References\RankPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\CmisService\References\AwardPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpfService\References\FolderPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\References\BuiltPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\Transactions\LogPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\References\AgencyPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\References\CoursePermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\References\EthnicPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\References\RegionPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\References\SchoolPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\CmisService\References\FormulaPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\CmisService\References\PurposePermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\References\BdaSizePermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\References\CountryPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\References\ZipcodePermissionsTableSeeder;
use Database\Seeders\ApiService\v1\ToeisService\Transactions\UnitPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\CmisService\References\CriteriaPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\References\AfposmosPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\References\BarangayPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\References\ExamTypePermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\References\EyeColorPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\References\HairTypePermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\References\LanguagePermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\References\MuniCityPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\References\ProvincePermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\References\ReligionPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\References\TrainingPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\OrderPubService\References\TypePermissionsTableSeeder;
use Database\Seeders\ApiService\v1\ToeisService\References\EchelonPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\CmisService\References\AwardTypePermissionsTableSeeder;
use Database\Seeders\ApiService\v1\CmisService\References\SubFactorPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\References\HairColorPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\References\InsurancePermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\References\PersonnelPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\CmisService\References\AwardPointPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\References\AssignmentPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\References\RankStatusPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\Transactions\IDSystemPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\OrderPubService\References\StatusPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\CmisService\Transactions\PromotionPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpfService\References\DocumentTypePermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\References\AccountTypePermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\References\CitizenshipPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\References\CivilStatusPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\Transactions\DashboardPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\CmisService\References\AppurtenancePermissionsTableSeeder;
use Database\Seeders\ApiService\v1\CmisService\Transactions\TSubFactorPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\References\RankCategoryPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\References\RelationshipPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\Transactions\TarrifSizePermissionsTableSeeder;
use Database\Seeders\ApiService\v1\OrderPubService\References\CategoryPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\OrderPubService\References\TemplatePermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\References\InsuranceTypePermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\References\PersonnelTypePermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\Transactions\EligibilityPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\Transactions\WorkHistoryPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\OrderPubService\References\ModelListPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\ToeisService\References\UnitLocationPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\References\EducationLevelPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\References\MilitarySchoolPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\References\PersonnelGroupPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\Transactions\GovernmentIdPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\Transactions\SerialNumberPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\ToeisService\References\TOEAssignmentPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\References\BranchOfServicePermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\Transactions\FamilyHistoryPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\Transactions\PersonnelRankPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\Transactions\PersonnelUnitPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\CmisService\Transactions\TableStructurePermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpfService\Transactions\PersonnelFolderPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\Transactions\CountryVisitedPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\Transactions\PersonnelAwardPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\OrderPubService\Transactions\OrderRoutePermissionsTableSeeder;
use Database\Seeders\ApiService\v1\CmisService\References\AppurtenanceAwardPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\CmisService\References\CommandAssignmentPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\CmisService\References\SubFactorLevelOnePermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpfService\Transactions\UploadAttachmentPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\Transactions\InsuranceRecordPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\OrderPubService\References\AuthorityLinePermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpfService\Transactions\PersonnelDocumentPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\OrderPubService\References\DocumentSettingPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\OrderPubService\Transactions\FileDirectoryPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\ToeisService\Transactions\TaskOrganizationPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\CmisService\Transactions\TSubFactorLevelOnePermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\Transactions\CharacterReferencePermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\Transactions\CommunicationSkillPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\Transactions\FinancialReferencePermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\Transactions\PersonnelPromotionPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\Transactions\SocialOrganizationPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\OrderPubService\Transactions\PersonnelOrderPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\Transactions\PersonnelEnlistmentPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\OrderPubService\References\OriginatingOfficePermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\Transactions\CivilianCommendationPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\Transactions\PersonalCharacteristicPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\Transactions\PersonnelDutyAssignmentPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\Transactions\PersonnelUnitAssignmentPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\OrderPubService\References\DocumentSettingSignatoryPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\References\PurposePermissionsTableSeeder as MpisPurposePermissionsTableSeeder;
use Database\Seeders\ApiService\v1\OrderPubService\Transactions\FolderPermissionsTableSeeder as OrderPubFolderPermissionsTableSeeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SettingsTableSeeder::class);
        $this->call(TeamsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(ModulesTableSeeder::class);
        $this->call(RolesTableSeeder::class);

        //CMIS
        $this->call(AppurtenancePermissionsTableSeeder::class);
        $this->call(SubFactorPermissionsTableSeeder::class);
        $this->call(SubFactorLevelOnePermissionsTableSeeder::class);
        $this->call(PurposePermissionsTableSeeder::class);
        $this->call(AwardPermissionsTableSeeder::class);
        $this->call(AwardTypePermissionsTableSeeder::class);
        $this->call(AwardPointPermissionsTableSeeder::class);
        $this->call(CriteriaPermissionsTableSeeder::class);
        $this->call(FormulaPermissionsTableSeeder::class);
        $this->call(QrsPermissionsTableSeeder::class);
        $this->call(TableStructurePermissionsTableSeeder::class);
        $this->call(SubFactorPermissionsTableSeeder::class);
        $this->call(SubFactorLevelOnePermissionsTableSeeder::class);
        $this->call(TSubFactorLevelOnePermissionsTableSeeder::class);
        $this->call(TSubFactorPermissionsTableSeeder::class);
        $this->call(AppurtenanceAwardPermissionsTableSeeder::class);
        $this->call(PromotionPermissionsTableSeeder::class);
        //Mpis
        $this->call(CountryPermissionsTableSeeder::class);
        $this->call(PersonnelPermissionsTableSeeder::class);
        $this->call(BarangayPermissionsTableSeeder::class);
        $this->call(BdaSizePermissionsTableSeeder::class);
        $this->call(BuiltPermissionsTableSeeder::class);
        $this->call(CitizenshipPermissionsTableSeeder::class);
        $this->call(MuniCityPermissionsTableSeeder::class);
        $this->call(CoursePermissionsTableSeeder::class);
        $this->call(EducationLevelPermissionsTableSeeder::class);
        $this->call(EthnicPermissionsTableSeeder::class);
        $this->call(EyeColorPermissionsTableSeeder::class);
        $this->call(HairColorPermissionsTableSeeder::class);
        $this->call(HairTypePermissionsTableSeeder::class);
        $this->call(ProvincePermissionsTableSeeder::class);
        $this->call(ReligionPermissionsTableSeeder::class);
        $this->call(SchoolPermissionsTableSeeder::class);
        $this->call(PersonnelTypePermissionsTableSeeder::class);
        $this->call(BranchOfServicePermissionsTableSeeder::class);
        $this->call(RankStatusPermissionsTableSeeder::class);
        $this->call(PersonnelGroupPermissionsTableSeeder::class);
        $this->call(RankCategoryPermissionsTableSeeder::class);
        $this->call(RegionPermissionsTableSeeder::class);
        $this->call(FamilyHistoryPermissionsTableSeeder::class);
        $this->call(PersonalCharacteristicPermissionsTableSeeder::class);
        $this->call(TarrifSizePermissionsTableSeeder::class);
        $this->call(CivilStatusPermissionsTableSeeder::class);
        $this->call(CharacterReferencePermissionsTableSeeder::class);
        $this->call(CivilianCommendationPermissionsTableSeeder::class);
        $this->call(CommunicationSkillPermissionsTableSeeder::class);
        $this->call(CountryVisitedPermissionsTableSeeder::class);
        $this->call(EligibilityPermissionsTableSeeder::class);
        $this->call(FinancialReferencePermissionsTableSeeder::class);
        $this->call(GovernmentIdPermissionsTableSeeder::class);
        $this->call(SocialOrganizationPermissionsTableSeeder::class);
        $this->call(WorkHistoryPermissionsTableSeeder::class);
        $this->call(RankPermissionsTableSeeder::class);
        $this->call(SerialNumberPermissionsTableSeeder::class);
        $this->call(TrainingPermissionsTableSeeder::class);
        $this->call(ZipcodePermissionsTableSeeder::class);
        $this->call(RelationshipPermissionsTableSeeder::class);
        $this->call(AfposmosPermissionsTableSeeder::class);
        $this->call(PersonnelRankPermissionsTableSeeder::class);
        $this->call(PersonnelAwardPermissionsTableSeeder::class);
        $this->call(LogPermissionsTableSeeder::class);
        $this->call(DashboardPermissionsTableSeeder::class);
        $this->call(PersonnelEnlistmentPermissionsTableSeeder::class);
        $this->call(AssignmentPermissionsTableSeeder::class);
        $this->call(LanguagePermissionsTableSeeder::class);
        $this->call(ExamTypePermissionsTableSeeder::class);
        $this->call(BankPermissionsTableSeeder::class);
        $this->call(AccountTypePermissionsTableSeeder::class);
        $this->call(InsurancePermissionsTableSeeder::class);
        $this->call(InsuranceTypePermissionsTableSeeder::class);
        $this->call(AgencyPermissionsTableSeeder::class);
        $this->call(InsuranceRecordPermissionsTableSeeder::class);
        $this->call(PurposePermissionsTableSeeder::class);
        $this->call(PersonnelUnitPermissionsTableSeeder::class);
        $this->call(MilitarySchoolPermissionsTableSeeder::class);
        $this->call(PersonnelPromotionPermissionsTableSeeder::class);
        $this->call(PersonnelDutyAssignmentPermissionsTableSeeder::class);
        $this->call(PersonnelUnitAssignmentPermissionsTableSeeder::class);
        $this->call(IDSystemPermissionsTableSeeder::class);
        //Mpf
        $this->call(FolderPermissionsTableSeeder::class);
        $this->call(PersonnelFolderPermissionsTableSeeder::class);
        $this->call(UploadAttachmentPermissionsTableSeeder::class);
        $this->call(DocumentTypePermissionsTableSeeder::class);
        $this->call(PersonnelDocumentPermissionsTableSeeder::class);

        //OrderPub
        $this->call(AuthorityLinePermissionsTableSeeder::class);
        $this->call(CategoryPermissionsTableSeeder::class);
        $this->call(TemplatePermissionsTableSeeder::class);
        $this->call(TypePermissionsTableSeeder::class);
        $this->call(ModelListPermissionsTableSeeder::class);
        $this->call(DocumentSettingPermissionsTableSeeder::class);
        $this->call(DocumentSettingSignatoryPermissionsTableSeeder::class);
        $this->call(OrderPubFolderPermissionsTableSeeder::class);
        $this->call(OrderRoutePermissionsTableSeeder::class);
        $this->call(StatusPermissionsTableSeeder::class);
        $this->call(OriginatingOfficePermissionsTableSeeder::class);
        $this->call(FileDirectoryPermissionsTableSeeder::class);
        $this->call(PersonnelOrderPermissionsTableSeeder::class);

        //TOEIS
        $this->call(EchelonPermissionsTableSeeder::class);
        $this->call(UnitPermissionsTableSeeder::class);
        $this->call(UnitLocationPermissionsTableSeeder::class);
        $this->call(TOEAssignmentPermissionsTableSeeder::class);
    }
}
