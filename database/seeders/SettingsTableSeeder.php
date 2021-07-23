<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Repositories\Interfaces\SettingRepositoryInterface;

class SettingsTableSeeder extends Seeder
{
    public function __construct(SettingRepositoryInterface $settingRepository)
    {
        $this->settingRepository = $settingRepository;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->settingRepository->updateOrCreate([
            'project_label' => 'PAHRMIS',
            'project_description' => 'Philippine Army Human Resource Management Information System',
            'frontend_domain' => 'http://127.0.0.1',
            'max_login_attempts' => 5,
            'captcha_login_attempts' => 3,
            'block_duration' => 2,
            'otp_digits' => 6,
            'otp_expiration' => 5,
            'mail_expiration' => 60,
            'pin_digits' => 4
        ]);
    }
}
