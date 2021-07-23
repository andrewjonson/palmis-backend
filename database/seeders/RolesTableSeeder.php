<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Repositories\Interfaces\RoleRepositoryInterface;

class RolesTableSeeder extends Seeder
{
    public function __construct(RoleRepositoryInterface $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            'Admin',
            'Encoder',
            'Viewer'
        ];

        foreach($roles as $role) {
            $this->roleRepository->updateOrCreate([
                'name' => $role,
                'guard_name' => 'api'
            ]);
        }
    }
}
