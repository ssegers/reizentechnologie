<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDayPlanningTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('day_plannings', function (Blueprint $table) {
            $table->increments('day_planning_id');
            $table->integer('trip_id')->unsigned();
            $table->foreign('trip_id')->references('trip_id')->on('trips')->onDelete("cascade");
            $table->date('date');
            $table->string('highlight');
            $table->string('description');
            $table->string('location');
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
        Schema::dropIfExists('day_planning');
    }
}
