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
            $table->dateTime('timestampcreate');
            $table->dateTime('timestampdelete');
            $table->integer('minutes')->default(0);
            $table->integer('tickettypeid')->nullable()->index('FK_vrtickets_vrtickettypes_0');
            $table->integer('bookingid')->nullable()->index('FK_trickets_booking');
            $table->integer('clientid')->nullable()->index('FK_vrtickets_vrclients_1');
            $table->dateTime('starttime')->nullable();
            $table->dateTime('endtime')->nullable();
            $table->boolean('isdeleted');
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
