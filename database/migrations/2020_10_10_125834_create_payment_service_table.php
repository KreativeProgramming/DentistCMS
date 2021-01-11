<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_service', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('payment_id')->unsigned();
            $table->foreign('payment_id')->references('id')->on('payments');
            $table->bigInteger('service_id')->unsigned();
            $table->foreign('service_id')->references('id')->on('services');
            $table->string('tooth');
            $table->string('discount');
            $table->timestamps(); $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_service');
    }
}
