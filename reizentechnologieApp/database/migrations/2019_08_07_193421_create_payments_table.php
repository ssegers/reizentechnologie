<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('payment_id');
            $table->integer('traveller_id')->unsigned();
            $table->integer('trip_id')->unsigned();
            $table->integer('amount')->nullable();
            $table->date('date_of_payment')->nullable();
            $table->timestamps();
            $table->foreign('traveller_id')->references('traveller_id')->on('travellers')->onDelete("cascade");
            $table->foreign('trip_id')->references('trip_id')->on('trips')->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
