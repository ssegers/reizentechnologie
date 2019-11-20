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
            'traveller_id' => 3,
            'room_id' => 1,
        ));
        DB::table('room_traveller')->insert(array(
            'traveller_id' => 5,
            'room_id' => 1,
        ));
        DB::table('room_traveller')->insert(array(
            'traveller_id' => 7,
            'room_id' => 1,
        ));
    }
}
