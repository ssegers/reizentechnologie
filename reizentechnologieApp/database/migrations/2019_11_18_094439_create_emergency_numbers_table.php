<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmergencyNumbersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emergency_numbers', function (Blueprint $table) {
            $table->increments('emergency_number_id');
            $table->integer("trip_id")->unsigned();
            $table->foreign('trip_id')->references('trip_id')->on('trips')->onDelete("cascade");
            $table->string('number');
            $table->string('first_name');
            $table->string('last_name');
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
        Schema::dropIfExists('emergency_numbers');
    }
}
