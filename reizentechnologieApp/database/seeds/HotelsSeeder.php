<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HotelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('hotels')->insert(array(
            'hotel_name' => 'hotel_1',
            'trip_destination' => 'Amerika',
            'address' => 'address1',
        ));

        DB::table('hotels')->insert(array(
            'hotel_name' => 'hotel_2',
            'trip_destination' => 'Amerika',
            'address' => 'address2',
        ));

        DB::table('hotels')->insert(array(
            'hotel_name' => 'hotel_3',
            'trip_destination' => 'Duitsland',
            'address' => 'address3',
        ));
    }
}
