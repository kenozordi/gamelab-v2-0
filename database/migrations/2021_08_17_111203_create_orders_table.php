<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('order_no', 45);
            $table->integer('gamer_id')->nullable();
            $table->decimal('total', 13);
            $table->timestamp('order_date')->nullable();
            $table->integer('status')->nullable()->default(1);
            $table->text('additional_info')->nullable();
            $table->string('system_ref', 145)->nullable();
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
        Schema::dropIfExists('orders');
    }
}
