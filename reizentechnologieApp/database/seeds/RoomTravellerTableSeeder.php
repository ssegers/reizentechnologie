<?php

use Illuminate\Database\Seeder;

class RoomTravellerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('room_traveller')->insert(array(
            'traveller_id' => 1,
            'room_id' => 1,
        ));
        DB::table('room_traveller')->insert(array(
            'traveller_id' => 2,
            'room_id' => 1,
        ));
        DB::table('room_traveller')->insert(array(
            'traveller_id' => 3,
            'room_id' => 2,
        ));
        DB::table('room_traveller')->insert(array(
            'traveller_id' => 4,
            'room_id' => 2,
        ));
        DB::table('room_traveller')->insert(array(
            'traveller_id' => 6,
            'room_id' => 2,
        ));
        DB::table('room_traveller')->insert(array(
            'traveller_id' => 8,
            'room_id' => 2,
        ));
        DB::table('room_traveller')->insert(array(
            'traveller_id' => 10,
            'room_id' => 2,
        ));
        DB::table('room_traveller')->insert(array(
            'traveller_id' => 12,
            'room_id' => 4,
        ));
        DB::table('room_traveller')->insert(array(
            'traveller_id' => 14,
            'room_id' => 4,
        ));
        DB::table('room_traveller')->insert(array(
            'traveller_id' => 16,
            'room_id' => 4,
        ));
        DB::table('room_traveller')->insert(array(
            'traveller_id' => 18,
            'room_id' => 4,
        ));
		DB::table('room_traveller')->insert(array(
            'traveller_id' => 20,
            'room_id' => 3,
        ));
        DB::table('room_traveller')->insert(array(
            'traveller_id' => 22,
            'room_id' => 3,
        ));
        DB::table('room_traveller')->insert(array(
            'traveller_id' => 24,
            'room_id' => 3,
        ));
        DB::table('room_traveller')->insert(array(
            'traveller_id' => 28,
            'room_id' => 3,
        ));
    }
}
