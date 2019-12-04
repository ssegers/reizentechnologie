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
        DB::table('hotel_trips')->insert(array(
            'hotel_id' => 1,
            'trip_id' => 1,
            'start_date'=>Carbon::create('2020', '05', '21'),
            'end_date'=>Carbon::create('2020', '05', '23')
        ));
        DB::table('hotel_trips')->insert(array(
            'hotel_id' => 2,
            'trip_id' => 1,
            'start_date'=>Carbon::create('2020', '05', '24'),
            'end_date'=>Carbon::create('2020', '05', '25')

        ));
        DB::table('hotel_trips')->insert(array(
            'hotel_id' => 3,
            'trip_id' => 1,
            'start_date'=>Carbon::create('2020', '05', '26'),
            'end_date'=>Carbon::create('2020', '05', '26')

        ));
        DB::table('hotel_trips')->insert(array(
            'hotel_id' => 4,
            'trip_id' => 1,
            'start_date'=>Carbon::create('2020', '05', '27'),
            'end_date'=>Carbon::create('2020', '05', '28')

        ));
        DB::table('hotel_trips')->insert(array(
            'hotel_id' => 5,
            'trip_id' => 1,
            'start_date'=>Carbon::create('2020', '05', '19'),
            'end_date'=>Carbon::create('2020', '05', '30')

        ));
    }
}
