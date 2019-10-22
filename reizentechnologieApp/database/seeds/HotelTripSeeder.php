<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class HotelTripSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('hotel_trip')->insert(array(
            'hotel_id' => 1,
            'trip_id' => 1,
            'start_date'=>Carbon::create('2018', '12', '15'),
            'end_date'=>Carbon::create('2018', '12', '16')
        ));
        DB::table('hotel_trip')->insert(array(
            'hotel_id' => 2,
            'trip_id' => 1,
            'start_date'=>Carbon::create('2018', '12', '16'),
            'end_date'=>Carbon::create('2018', '12', '19')

        ));
        DB::table('hotel_trip')->insert(array(
            'hotel_id' => 3,
            'trip_id' => 2,
            'start_date'=>Carbon::create('2018', '12', '19'),
            'end_date'=>Carbon::create('2018', '12', '20')
        ));
    }
}
