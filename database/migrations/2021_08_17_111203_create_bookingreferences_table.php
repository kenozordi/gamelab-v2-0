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
            $table->integer('gamer')->nullable();
            $table->boolean('status')->nullable()->default(1);
            $table->integer('duration');
            $table->string('start_time', 256);
            $table->string('end_time', 256);
            $table->string('expires_at', 256);
            $table->integer('client_id');
            $table->integer('game_id')->nullable();
            // $table->integer('order_id')->nullable();
            $table->string('order_no')->nullable();
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
