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
            $table->integer('id', true);
            $table->string('email', 256)->nullable();
            $table->boolean('email_confirmed')->nullable();
            $table->string('fullname', 256);
            $table->longText('password');
            $table->longText('SecurityStamp')->nullable();
            $table->longText('phone')->nullable();
            $table->boolean('phone_confirmed')->nullable();
            $table->boolean('TwoFactorEnabled')->nullable();
            $table->dateTime('LockoutEndDateUtc')->nullable();
            $table->boolean('LockoutEnabled')->nullable();
            $table->integer('AccessFailedCount')->nullable();
            $table->string('username', 256);
            $table->dateTime('last_login')->nullable();
            $table->boolean('isdeleted')->nullable();
            $table->integer('role')->nullable();
            $table->integer('status')->default(1);
            $table->integer('password_reset')->nullable();
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
