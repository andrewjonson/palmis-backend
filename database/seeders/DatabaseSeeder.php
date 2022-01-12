<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\DatabaseSeeder;
use Database\Seeders\RolesTableSeeder;
use Database\Seeders\TeamsTableSeeder;
use Database\Seeders\UsersTableSeeder;
use Database\Seeders\ModulesTableSeeder;
use Database\Seeders\SettingsTableSeeder;

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
    }
}
