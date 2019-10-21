<?php

use Illuminate\Database\Seeder;

class HotelTripTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('hoteltrip')->insert(array(
            'trip_id' => 1,
            'hotel_id' => 1
        ));
    }
}
