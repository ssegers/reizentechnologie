<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTravellersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('travellers', function (Blueprint $table) {

            $table->increments('traveller_id');
            $table->integer("user_id")->unique()->unsigned();       //foreign key moet unsigned zijn    -JM
            $table->integer('zip_id')->unsigned();
            $table->integer('major_id')->unsigned();
            $table->string("first_name");
            $table->string("last_name");
            $table->string('email')->unique();
            $table->string("country");
            $table->string("address");
            $table->string("gender");
            $table->string("phone");
            $table->string("emergency_phone_1");
            $table->string("emergency_phone_2")->nullable();
            $table->string("nationality");
            $table->date("birthdate");
            $table->string("birthplace");
            $table->string("iban");
            $table->string("bic");
            $table->boolean("medical_issue");
            $table->string("medical_info")->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('user_id')->references('user_id')->on('users')->onDelete("cascade");
            $table->foreign('zip_id')->references('zip_id')->on('zips');
            $table->foreign('major_id')->references('major_id')->on('majors');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('travellers');
    }
}
