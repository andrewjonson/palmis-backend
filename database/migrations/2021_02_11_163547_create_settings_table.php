<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('project_label');
            $table->string('project_description');
            $table->string('project_logo')->nullable();
            $table->string('frontend_domain');
            $table->integer('max_login_attempts');
            $table->integer('captcha_login_attempts');
            $table->integer('block_duration');
            $table->integer('otp_digits');
            $table->integer('otp_expiration');
            $table->integer('mail_expiration');
            $table->integer('pin_digits');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}