<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGameappconfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gameappconfigs', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('tileguid');
            $table->longText('tiletitle');
            $table->integer('tileheight');
            $table->integer('tilewidth');
            $table->integer('agerequire')->default(0);
            $table->binary('imagedata');
            $table->longText('tiledesc');
            $table->longText('command');
            $table->longText('arguments');
            $table->longText('workingpath');
            $table->longText('videourl');
            $table->integer('Order');
            $table->integer('tilerownumber');
            $table->integer('tileconfigsetid');
            $table->integer('vrtileconfigid');
            $table->boolean('isdeleted');
            $table->boolean('featured')->nullable()->default(2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gameappconfigs');
    }
}
