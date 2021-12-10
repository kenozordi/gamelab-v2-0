<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClienthistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clienthistories', function (Blueprint $table) {
            $table->integer('id', true);
            $table->dateTime('starttime')->nullable();
            $table->dateTime('endtime')->nullable();
            $table->integer('tileconfigid');
            $table->integer('vrclientid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clienthistories');
    }
}
