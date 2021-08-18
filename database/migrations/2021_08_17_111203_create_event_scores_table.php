<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_scores', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('event')->nullable();
            $table->string('gamer', 45)->nullable();
            $table->string('avatar', 45)->nullable();
            $table->integer('score')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_scores');
    }
}
