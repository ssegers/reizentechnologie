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
            $table->increments('id');
            $table->string('number');
            $table->integer('traveller_id')->unsigned();
            $table->foreign('traveller_id')->references('traveller_id')->on('travellers')->onDelete("cascade");
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
