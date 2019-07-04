<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTravellerTripTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('traveller_trip', function (Blueprint $table) {
            $table->increments('id')->unsigned(); //wordt alleen gebruikt door eloquent zelf
            $table->integer('trip_id')->unsigned();
            $table->integer('traveller_id')->unsigned();
            $table->boolean('is_guide')->default(false);
            $table->boolean('is_organizer')->default(false);
            $table->timestamps();
            $table->foreign('trip_id')->references('trip_id')->on('trips')->onDelete("cascade");
            $table->foreign('traveller_id')->references('traveller_id')->on('travellers')->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('traveller_trip');
    }
}
