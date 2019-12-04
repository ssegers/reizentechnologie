<?php

use Illuminate\Database\Seeder;

class RoomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('rooms')->insert(array(
            'hotel_trip_id' => 1,
            'size' => 2,
            'room_number' => 214,
        ));
        DB::table('rooms')->insert(array(
            'hotel_trip_id' => 1,
            'size' => 5,
            'room_number' => 215,
            ));
        DB::table('rooms')->insert(array(
            'hotel_trip_id' => 2,
            'size' => 4,
            'room_number' => 216,
        ));
        DB::table('rooms')->insert(array(
            'hotel_trip_id' => 1,
            'size' => 4,
            'room_number' => 135,
        ));
    }
}
