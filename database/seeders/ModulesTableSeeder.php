<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Repositories\Interfaces\ModuleRepositoryInterface;

class ModulesTableSeeder extends Seeder
{
    public function __construct(ModuleRepositoryInterface $moduleRepository)
    {
        $this->moduleRepository = $moduleRepository;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = [
            'mpis',
            'mpf',
            'orderpub',
            'ucs',
            'cmis'
        ];

        $descriptions = [
            'MPIS',
            'MPF',
            'Order and Publication',
            'UCS',
            'CMIS'
        ];

        foreach($names as $key => $name) {
            $this->moduleRepository->firstOrCreate([
                'name' => $name,
                'description' => $descriptions[$key],
                'created_by' => 1,
                'updated_by' => 1
            ]);
        }
    }
}
