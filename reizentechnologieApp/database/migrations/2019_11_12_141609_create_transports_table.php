<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transports', function (Blueprint $table) {
            $table->increments('transport_id');
            $table->integer('trip_id')->unsigned();
            $table->integer('driver_id')->unsigned()->nullable();
            $table->foreign('trip_id')->references('trip_id')->on('trips')->onDelete("cascade");
            $table->foreign('driver_id')->references('traveller_id')->on('travellers')->onDelete("cascade");
            $table->integer('size');
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
        Schema::dropIfExists('transports');
    }
}
