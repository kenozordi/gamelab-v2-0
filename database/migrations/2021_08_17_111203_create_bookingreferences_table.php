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
            $table->string('gamer', 128)->nullable();
            $table->string('status', 10);
            $table->boolean('paymentstatus')->default(0);
            $table->integer('duration');
            $table->dateTime('bookingstarttime')->nullable();
            $table->dateTime('bookingendtime')->nullable();
            $table->dateTime('timestampcreate');
            $table->dateTime('bookingchanged')->nullable();
            $table->dateTime('bookingdeleted')->nullable();
            $table->integer('client')->nullable();
            $table->boolean('gamepassissued')->nullable()->default(0);
            $table->integer('order_id')->nullable();
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
