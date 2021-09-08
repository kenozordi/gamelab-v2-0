<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('type')->nullable();
            $table->double('amount', 255, 0)->nullable();
            $table->text('system_ref')->nullable();
            $table->string('status', 10)->nullable();
            $table->text('message')->nullable();
            $table->string('currency', 10)->nullable();
            $table->string('order_no', 45);
            $table->integer('gamer_id')->nullable()->index('fk_payment_user');
            $table->dateTime('created')->nullable();
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
        Schema::dropIfExists('payment');
    }
}
