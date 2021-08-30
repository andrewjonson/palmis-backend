<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\ApiService\v1\MpfService\References\TabPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpfService\References\GroupPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpfService\Transactions\MpfPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpfService\Transactions\SubPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\References\BuiltPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\References\CoursePermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\References\EthnicPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\References\RegionPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\References\SchoolPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\References\BdaSizePermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\References\BarangayPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\References\EyeColorPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\References\HairTypePermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\References\MuniCityPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\References\ProvincePermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\References\ReligionPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\OrderPubService\References\TypePermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\References\HairColorPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\References\PersonnelPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpfService\References\SubCategoryPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpfService\References\MainCategoryPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\References\CitizenshipPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\References\CivilStatusPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\References\RankCategoryPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\Transactions\TarrifSizePermissionsTableSeeder;
use Database\Seeders\ApiService\v1\OrderPubService\References\CategoryPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\OrderPubService\References\TemplatePermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\References\PersonnelTypePermissionsTableSeeder;
use Database\Seeders\ApiService\v1\OrderPubService\References\ModelListPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\References\EducationLevelPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\References\PersonnelGroupPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\References\BranchOfServicePermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\Transactions\FamilyHistoryPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpfService\Transactions\PersonnelProfilePermissionsTableSeeder;
use Database\Seeders\ApiService\v1\OrderPubService\References\DocumentSettingPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\Transactions\CharacterReferencePermissionsTableSeeder;
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

        //Mpis
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
        //Mpf
        $this->call(GroupPermissionsTableSeeder::class);
        $this->call(MainCategoryPermissionsTableSeeder::class);
        $this->call(SubCategoryPermissionsTableSeeder::class);
        $this->call(TabPermissionsTableSeeder::class);
        $this->call(MpfPermissionsTableSeeder::class);
        $this->call(PersonnelProfilePermissionsTableSeeder::class);
        $this->call(SubPermissionsTableSeeder::class);

        //OrderPub
        $this->call(CategoryPermissionsTableSeeder::class);
        $this->call(TemplatePermissionsTableSeeder::class);
        $this->call(TypePermissionsTableSeeder::class);
        $this->call(ModelListPermissionsTableSeeder::class);
        $this->call(DocumentSettingPermissionsTableSeeder::class);
        $this->call(DocumentSettingSignatoryPermissionsTableSeeder::class);

    }
}
