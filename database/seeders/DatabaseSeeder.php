<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\ApiService\v1\MpfService\References\TabPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\CmisService\References\QrsPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpfService\References\GroupPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpfService\Transactions\MpfPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpfService\Transactions\SubPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\References\RankPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\CmisService\References\AwardPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\References\BuiltPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\References\CoursePermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\References\EthnicPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\References\RegionPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\References\SchoolPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\CmisService\References\FormulaPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\CmisService\References\PurposePermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\References\BdaSizePermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\References\CountryPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\References\BarangayPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\References\EyeColorPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\References\HairTypePermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\References\MuniCityPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\References\ProvincePermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\References\ReligionPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\References\TrainingPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\OrderPubService\References\TypePermissionsTableSeeder;
use Database\Seeders\ApiService\v1\CmisService\References\SubFactorPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\References\HairColorPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\References\PersonnelPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpfService\References\SubCategoryPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\OrderPubService\References\StatusPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpfService\References\MainCategoryPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\References\CitizenshipPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\References\CivilStatusPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\Transactions\InsurancePermissionsTableSeeder;
use Database\Seeders\ApiService\v1\CmisService\References\AppurtenancePermissionsTableSeeder;
use Database\Seeders\ApiService\v1\CmisService\Transactions\TSubFactorPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\References\RankCategoryPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\Transactions\TarrifSizePermissionsTableSeeder;
use Database\Seeders\ApiService\v1\OrderPubService\References\CategoryPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\OrderPubService\References\TemplatePermissionsTableSeeder;
use Database\Seeders\ApiService\v1\OrderPubService\Transactions\FolderPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\References\PersonnelTypePermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\Transactions\EligibilityPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\Transactions\WorkHistoryPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\OrderPubService\References\ModelListPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\References\EducationLevelPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\References\PersonnelGroupPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\Transactions\GovernmentIdPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\Transactions\SerialNumberPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\References\BranchOfServicePermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\Transactions\FamilyHistoryPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\CmisService\Transactions\TableStructurePermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\Transactions\CountryVisitedPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\OrderPubService\Transactions\OrderRoutePermissionsTableSeeder;
use Database\Seeders\ApiService\v1\CmisService\References\SubFactorLevelOnePermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpfService\Transactions\PersonnelProfilePermissionsTableSeeder;
use Database\Seeders\ApiService\v1\OrderPubService\References\AuthorityLinePermissionsTableSeeder;
use Database\Seeders\ApiService\v1\OrderPubService\References\DocumentSettingPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\CmisService\Transactions\TSubFactorLevelOnePermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\Transactions\CharacterReferencePermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\Transactions\CommunicationSkillPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\Transactions\FinancialReferencePermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\Transactions\SocialOrganizationPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\Transactions\CivilianCommendationPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\Transactions\PersonalCharacteristicPermissionsTableSeeder;


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
        $this->call(InsurancePermissionsTableSeeder::class);
        $this->call(SocialOrganizationPermissionsTableSeeder::class);
        $this->call(WorkHistoryPermissionsTableSeeder::class);
        $this->call(RankPermissionsTableSeeder::class);
        $this->call(SerialNumberPermissionsTableSeeder::class);
        $this->call(TrainingPermissionsTableSeeder::class);


        //Mpf
        $this->call(GroupPermissionsTableSeeder::class);
        $this->call(MainCategoryPermissionsTableSeeder::class);
        $this->call(SubCategoryPermissionsTableSeeder::class);
        $this->call(TabPermissionsTableSeeder::class);
        $this->call(MpfPermissionsTableSeeder::class);
        $this->call(PersonnelProfilePermissionsTableSeeder::class);
        $this->call(SubPermissionsTableSeeder::class);

        //OrderPub
        $this->call(AuthorityLinePermissionsTableSeeder::class);
        $this->call(CategoryPermissionsTableSeeder::class);
        $this->call(TemplatePermissionsTableSeeder::class);
        $this->call(TypePermissionsTableSeeder::class);
        $this->call(ModelListPermissionsTableSeeder::class);
        $this->call(DocumentSettingPermissionsTableSeeder::class);
        $this->call(DocumentSettingSignatoryPermissionsTableSeeder::class);
        $this->call(FolderPermissionsTableSeeder::class);
        $this->call(OrderRoutePermissionsTableSeeder::class);
        $this->call(StatusPermissionsTableSeeder::class);
    }
}
