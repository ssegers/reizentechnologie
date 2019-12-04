<?php

use Illuminate\Database\Seeder;

class TravellerTripSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Segers organisator Amerika en reist
        DB::table('traveller_trip')->insert([
            'trip_id' => 1,
            'traveller_id' => 1,
            'is_guide' => true,
            'is_organizer' => true,
        ]);
        //Segers organisator Duitsland
        DB::table('traveller_trip')->insert([
            'trip_id' => 2,
            'traveller_id' => 1,
            'is_guide' => false,
            'is_organizer' => true,
        ]);
        //Roox organisator Amerika
        DB::table('traveller_trip')->insert([
            'trip_id' => 1,
            'traveller_id' => 2,
            'is_guide' => false,
            'is_organizer' => true,
        ]);
        //Roox organisator Duitsland en reist
        DB::table('traveller_trip')->insert([
            'trip_id' => 2,
            'traveller_id' => 2,
            'is_guide' => true,
            'is_organizer' => false,
        ]);

        DB::table('traveller_trip')->insert([
            'trip_id' => 1,
            'traveller_id' => 3,
            'is_guide' => false,
            'is_organizer' => false,
        ]);

        DB::table('traveller_trip')->insert([
            'trip_id' => 1,
            'traveller_id' => 4,
            'is_guide' => false,
            'is_organizer' => false,
        ]);

        DB::table('traveller_trip')->insert([
            'trip_id' => 2,
            'traveller_id' => 5,
            'is_guide' => false,
            'is_organizer' => false,
        ]);
/******/
        DB::table('traveller_trip')->insert([
            'trip_id' => 1,
            'traveller_id' => 6,
            'is_guide' => false,
            'is_organizer' => false,
        ]);
        DB::table('traveller_trip')->insert([
            'trip_id' => 2,
            'traveller_id' => 7,
            'is_guide' => false,
            'is_organizer' => false,
        ]);
        DB::table('traveller_trip')->insert([
            'trip_id' => 1,
            'traveller_id' => 8,
            'is_guide' => false,
            'is_organizer' => false,
        ]);
        DB::table('traveller_trip')->insert([
            'trip_id' => 2,
            'traveller_id' => 9,
            'is_guide' => false,
            'is_organizer' => false,
        ]);
        DB::table('traveller_trip')->insert([
            'trip_id' => 1,
            'traveller_id' => 10,
            'is_organizer' => false,
        ]);
        DB::table('traveller_trip')->insert([
            'trip_id' => 2,
            'traveller_id' => 11,
            'is_organizer' => false,
        ]);
        DB::table('traveller_trip')->insert([
            'trip_id' => 1,
            'traveller_id' => 12,
            'is_organizer' => false,
        ]);
        DB::table('traveller_trip')->insert([
            'trip_id' => 2,
            'traveller_id' => 13,
            'is_organizer' => false,
        ]);
        DB::table('traveller_trip')->insert([
            'trip_id' => 1,
            'traveller_id' => 14,
            'is_organizer' => false,
        ]);
        DB::table('traveller_trip')->insert([
            'trip_id' => 2,
            'traveller_id' => 15,
            'is_organizer' => false,
        ]);
        DB::table('traveller_trip')->insert([
            'trip_id' => 1,
            'traveller_id' => 16,
            'is_organizer' => false,
        ]);
        DB::table('traveller_trip')->insert([
            'trip_id' => 2,
            'traveller_id' => 17,
            'is_organizer' => false,
        ]);
        DB::table('traveller_trip')->insert([
            'trip_id' => 1,
            'traveller_id' => 18,
            'is_organizer' => false,
        ]);
        DB::table('traveller_trip')->insert([
            'trip_id' => 2,
            'traveller_id' => 19,
            'is_organizer' => false,
        ]);
        DB::table('traveller_trip')->insert([
            'trip_id' => 1,
            'traveller_id' => 20,
            'is_organizer' => false,
        ]);
        DB::table('traveller_trip')->insert([
            'trip_id' => 2,
            'traveller_id' => 21,
            'is_organizer' => false,
        ]);
        DB::table('traveller_trip')->insert([
            'trip_id' => 1,
            'traveller_id' => 22,
            'is_organizer' => false,
        ]);
        DB::table('traveller_trip')->insert([
            'trip_id' => 2,
            'traveller_id' => 23,
            'is_organizer' => false,
        ]);
        DB::table('traveller_trip')->insert([
            'trip_id' => 1,
            'traveller_id' => 24,
            'is_organizer' => false,
        ]);
        DB::table('traveller_trip')->insert([
            'trip_id' => 2,
            'traveller_id' => 25,
            'is_organizer' => false,
        ]);
        DB::table('traveller_trip')->insert([
            'trip_id' => 1,
            'traveller_id' => 26,
            'is_organizer' => false,
        ]);
        DB::table('traveller_trip')->insert([
            'trip_id' => 2,
            'traveller_id' => 27,
            'is_organizer' => false,
        ]);
        DB::table('traveller_trip')->insert([
            'trip_id' => 1,
            'traveller_id' => 28,
            'is_organizer' => false,
        ]);
        DB::table('traveller_trip')->insert([
            'trip_id' => 2,
            'traveller_id' => 29,
            'is_organizer' => false,
        ]);
        DB::table('traveller_trip')->insert([
            'trip_id' => 1,
            'traveller_id' => 30,
            'is_organizer' => false,
        ]);
        DB::table('traveller_trip')->insert([
            'trip_id' => 2,
            'traveller_id' => 31,
            'is_organizer' => false,
        ]);
        DB::table('traveller_trip')->insert([
            'trip_id' => 1,
            'traveller_id' => 32,
            'is_organizer' => false,
        ]);
        DB::table('traveller_trip')->insert([
            'trip_id' => 2,
            'traveller_id' => 33,
            'is_organizer' => false,
        ]);
        DB::table('traveller_trip')->insert([
            'trip_id' => 1,
            'traveller_id' => 34,
            'is_guide' => false,
            'is_organizer' => false,
        ]);
        DB::table('traveller_trip')->insert([
            'trip_id' => 2,
            'traveller_id' => 35,
            'is_guide' => false,
            'is_organizer' => false,
        ]);
        DB::table('traveller_trip')->insert([
            'trip_id' => 1,
            'traveller_id' => 36,
            'is_guide' => false,
            'is_organizer' => false,
        ]);
        DB::table('traveller_trip')->insert([
            'trip_id' => 2,
            'traveller_id' => 37,
            'is_guide' => false,
            'is_organizer' => false,
        ]);
        DB::table('traveller_trip')->insert([
            'trip_id' => 1,
            'traveller_id' => 38,
            'is_guide' => false,
            'is_organizer' => false,
        ]);
        DB::table('traveller_trip')->insert([
            'trip_id' => 2,
            'traveller_id' => 39,
            'is_guide' => true,
            'is_organizer' => false,
        ]);
        DB::table('traveller_trip')->insert([
            'trip_id' => 1,
            'traveller_id' => 40,
            'is_guide' => true,
            'is_organizer' => false,
        ]);
        DB::table('traveller_trip')->insert([
            'trip_id' => 2,
            'traveller_id' => 41,
            'is_guide' => true,
            'is_organizer' => false,
        ]);
        DB::table('traveller_trip')->insert([
            'trip_id' => 1,
            'traveller_id' => 42,
            'is_guide' => true,
            'is_organizer' => false,
        ]);
        DB::table('traveller_trip')->insert([
            'trip_id' => 2,
            'traveller_id' => 43,
            'is_guide' => true,
            'is_organizer' => false,
        ]);
        DB::table('traveller_trip')->insert([
            'trip_id' => 1,
            'traveller_id' => 44,
            'is_guide' => true,
            'is_organizer' => false,
        ]);
        DB::table('traveller_trip')->insert([
            'trip_id' => 2,
            'traveller_id' => 45,
            'is_guide' => true,
            'is_organizer' => false,
        ]);
        DB::table('traveller_trip')->insert([
            'trip_id' => 1,
            'traveller_id' => 46,
            'is_guide' => true,
            'is_organizer' => false,
        ]);
        DB::table('traveller_trip')->insert([
            'trip_id' => 2,
            'traveller_id' => 47,
            'is_guide' => true,
            'is_organizer' => false,
        ]);
        DB::table('traveller_trip')->insert([
            'trip_id' => 1,
            'traveller_id' => 48,
            'is_guide' => true,
            'is_organizer' => false,
        ]);
        DB::table('traveller_trip')->insert([
            'trip_id' => 2,
            'traveller_id' => 49,
            'is_guide' => true,
            'is_organizer' => false,
        ]);
    }
}
