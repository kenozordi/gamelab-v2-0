<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->foreign('bookingid', 'FK_trickets_booking')->references('id')->on('bookingreferences');
            $table->foreign('clientid', 'FK_vrtickets_vrclients_1')->references('id')->on('clients')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('tickettypeid', 'FK_vrtickets_vrtickettypes_0')->references('id')->on('tickettypes')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropForeign('FK_trickets_booking');
            $table->dropForeign('FK_vrtickets_vrclients_1');
            $table->dropForeign('FK_vrtickets_vrtickettypes_0');
        });
    }
}
