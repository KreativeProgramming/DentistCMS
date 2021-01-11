<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePacientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pacients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('personal_number');
            $table->char('gender', 1);
            $table->date('date_of_birth');
            $table->string('address');
            $table->string('residence');
            $table->string('city');
            $table->string('phone');
            $table->string('email')->nullable(true);
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
        Schema::dropIfExists('pacients');
    }
}
