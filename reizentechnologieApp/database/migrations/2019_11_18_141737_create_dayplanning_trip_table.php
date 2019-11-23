<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDayplanningTripTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dayplanning_trip', function (Blueprint $table) {
            $table->increments('day_planning_trip_id');
            $table->integer('day_planning_id')->unsigned();
            $table->integer('trip_id')->unsigned();
            $table->foreign('day_planning_id')->references("day_planning_id")->on('day_plannings')->onDelete('cascade');
            $table->foreign('trip_id')->references('trip_id')->on('trips')->onDelete("cascade");
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
        Schema::dropIfExists('dayplanning_trip');
    }
}
