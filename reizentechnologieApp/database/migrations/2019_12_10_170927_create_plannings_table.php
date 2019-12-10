<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlanningTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plannings', function (Blueprint $table) {
            $table->increments('planning_id');
            $table->integer('activity_id')->unsigned();
            $table->foreign('activity_id')->references('activity_id')->on('activities')->onDelete("cascade");
            $table->integer('day_id')->unsigned();
            $table->foreign('day_id')->references('day_id')->on('days')->onDelete("cascade");
            $table->time('start_hour');
            $table->time('end_hour');
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
        Schema::dropIfExists('planning');
    }
}
