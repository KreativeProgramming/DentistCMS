<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pacient_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->date('date_of_appointment');
            $table->string('time_of_appointment');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('pacient_id')->references('id')->on('pacients');
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
        Schema::dropIfExists('appointments');
    }
}
