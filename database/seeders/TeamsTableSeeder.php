<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Repositories\Interfaces\TeamRepositoryInterface;

class TeamsTableSeeder extends Seeder
{
    public function __construct(TeamRepositoryInterface $teamRepository)
    {
        $this->teamRepository = $teamRepository;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->teamRepository->create([
            'name' => 'NETB',
            'created_by' => 1,
            'updated_by' => 1
        ]);
    }
}
