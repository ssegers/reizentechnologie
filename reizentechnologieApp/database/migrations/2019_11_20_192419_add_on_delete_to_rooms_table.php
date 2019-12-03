<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOnDeleteToRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE rooms ADD CONSTRAINT FK_locations FOREIGN KEY (hotel_trip_id) REFERENCES hotel_trip(id) ON DELETE CASCADE;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("ALTER TABLE rooms ADD CONSTRAINT FK_locations FOREIGN KEY (hotel_trip_id) REFERENCES hotel_trip(id);");
    }
}
