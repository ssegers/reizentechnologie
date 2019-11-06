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
            'type_of_accomodation' => 'an accomodation',
            'address' => 'address1',
            'phone' => '485476125',
            'email' => "example@ucll.be",
            'website_link' => 'https://link.to.some.hotel/info',
            'picture1_link' => 'https://link.to.some.hotel/pictures/pic1.jpeg',
            'picture2_link' => 'https://link.to.some.hotel/hotel.png',
        ));

        DB::table('hotels')->insert(array(
            'hotel_name' => 'hotel_2',
            'trip_destination' => 'Amerika',
            'type_of_accomodation' => 'an accomodation',
            'address' => 'address2',
            'phone' => '44785002',
            'email' => "hotel.org",
        ));

        DB::table('hotels')->insert(array(
            'hotel_name' => 'hotel_3',
            'trip_destination' => 'Duitsland',
            'address' => 'address3',
        ));
    }
}
