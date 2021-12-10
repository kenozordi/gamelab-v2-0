<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingreferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookingreferences', function (Blueprint $table) {
            $table->integer('id', true);
            $table->longText('reference');
            $table->integer('gamer_id')->nullable();
            $table->boolean('status')->nullable()->default(1);
            $table->integer('duration');
            $table->timestamp('start_time');
            $table->timestamp('end_time');
            $table->timestamp('expires_at');
            $table->integer('client_id');
            $table->integer('game_id')->nullable();
            $table->string('order_no')->nullable();
            $table->integer('amount');
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
        Schema::dropIfExists('bookingreferences');
    }
}
