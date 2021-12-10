<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->char('guid', 36)->primary();
            $table->boolean('status')->nullable()->default(1);
            $table->integer('tickettype_id')->index('FK_vrtickets_vrtickettypes_0');
            $table->integer('booking_id')->index('FK_trickets_booking');
            $table->integer('client_id')->index('FK_vrtickets_vrclients_1');
            $table->integer('order_id');
            $table->boolean('game_pass_issued')->nullable()->default(0);
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
        Schema::dropIfExists('tickets');
    }
}
