<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\ApiService\v1\MpfService\References\TabPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpfService\References\GroupPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpfService\Transactions\MpfPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpfService\Transactions\SubPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\OrderPubService\References\TypePermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpisService\References\PersonnelPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpfService\References\SubCategoryPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpfService\References\MainCategoryPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\OrderPubService\References\CategoryPermissionsTableSeeder;
use Database\Seeders\ApiService\v1\OrderPubService\References\TemplatePermissionsTableSeeder;
use Database\Seeders\ApiService\v1\MpfService\Transactions\PersonnelProfilePermissionsTableSeeder;

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
    }
}
