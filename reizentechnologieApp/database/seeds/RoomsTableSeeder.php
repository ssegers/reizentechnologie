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
        // rooms in hotel 1
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
            'hotel_trip_id' => 1,
            'size' => 4,
            'room_number' => 135,
        ));

        // rooms in hotel 2
        DB::table('rooms')->insert(array(
            'hotel_trip_id' => 2,
            'size' => 2,
            'room_number' => 123,
        ));
        DB::table('rooms')->insert(array(
            'hotel_trip_id' => 2,
            'size' => 5,
            'room_number' => 124,
            ));
        DB::table('rooms')->insert(array(
            'hotel_trip_id' => 2,
            'size' => 4,
            'room_number' => 156,
        ));

        // rooms in hotel 3
        DB::table('rooms')->insert(array(
            'hotel_trip_id' => 3,
            'size' => 2,
            'room_number' => 214,
        ));
        DB::table('rooms')->insert(array(
            'hotel_trip_id' => 3,
            'size' => 5,
            'room_number' => 215,
            ));
        DB::table('rooms')->insert(array(
            'hotel_trip_id' => 3,
            'size' => 4,
            'room_number' => 135,
        ));

        // rooms in hotel 4
        DB::table('rooms')->insert(array(
            'hotel_trip_id' => 4,
            'size' => 2,
            'room_number' => 214,
        ));
        DB::table('rooms')->insert(array(
            'hotel_trip_id' => 4,
            'size' => 5,
            'room_number' => 215,
            ));
        DB::table('rooms')->insert(array(
            'hotel_trip_id' => 4,
            'size' => 4,
            'room_number' => 135,
        ));

        // rooms in hotel 5
        DB::table('rooms')->insert(array(
            'hotel_trip_id' => 5,
            'size' => 2,
            'room_number' => 102,
        ));
        DB::table('rooms')->insert(array(
            'hotel_trip_id' => 5,
            'size' => 5,
            'room_number' => 175,
            ));
        DB::table('rooms')->insert(array(
            'hotel_trip_id' => 5,
            'size' => 4,
            'room_number' => 002,
        ));
    }
}
