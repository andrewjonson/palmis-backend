<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('afpsn');
            $table->string('email');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('is_superadmin')->default(0);
            $table->string('modules')->nullable();
            $table->boolean('otp_auth')->default(0);
            $table->integer('otp_code')->nullable();
            $table->datetime('otp_expire_at')->nullable();
            $table->text('two_factor_secret')->nullable();
            $table->text('two_factor_recovery_codes')->nullable();
            $table->boolean('auth_status')->default(0);
            $table->boolean('screen_lock')->default(0);
            $table->string('pin')->nullable();
            $table->tinyInteger('auth_type')->nullable();
            $table->timestamp('blocked_at')->nullable();
            $table->foreignId('created_by')
                    ->nullable()
                    ->constrained('users');
            $table->foreignId('updated_by')
                    ->nullable()
                    ->constrained('users');
            $table->foreignId('deleted_by')
                    ->nullable()
                    ->constrained('users');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
