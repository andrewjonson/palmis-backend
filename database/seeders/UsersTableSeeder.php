<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UsersTableSeeder extends Seeder
{
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $afpsn = [
            '903724',
            '960592',
            '962868',
            '962869',
            '962870',
            '962871',
            '962872',
            '962873',
            '962874',
            '962875',
            '962876',
            '962877',
            '962878',
            '962879',
            '962880',
            '962881',
            '962882',
            '962883'
        ];

        $emails = [
            'philarmee.superdmin@gmail.com',
            'akosiada0@gmail.com',
            'jomar.illana@gmail.com',
            'jbacosmo@gmail.com',
            'janrayleenofe@yahoo.com',
            'jmdev0219@gmail.com',
            'torinofrancis@gmail.com',
            'albatanamjt.dev@icloud.com',
            'jpaulopaz08@gmail.com',
            'andrew.jonson18@gmail.com',
            'jaypeegalang27@gmail.com',
            'jwarrencedro@gmail.com',
            'ismaelraful11@gmail.com',
            'baniaga.eugene@gmail.com',
            'henrydeguzman.java73@gmail.com',
            'dianamagno20@gmail.com',
            'johndavis156@gmail.com',
            'armydigz@gmail.com'
        ];

        foreach($emails as $key => $email) {
            $this->userRepository->updateOrcreate([
                'afpsn' => $afpsn[$key],
                'email' => $email,
                'is_superadmin' => true,
                'password' => Hash::make('pahrmis_2020'),
                'email_verified_at' => '2021-07-19',
                'team_id' => 1,
                'created_by' => 1,
                'updated_by' => 1
            ]);
        }
    }
}
