<?php

use Illuminate\Database\Seeder;

class TransportTravellerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('transport_traveller')->insert(array(
            'transport_id' => 1,
            'traveller_id' => 4,
        ));
        DB::table('transport_traveller')->insert(array(
            'transport_id' => 1,
            'traveller_id' => 5,
        ));
        DB::table('transport_traveller')->insert(array(
            'transport_id' => 1,
            'traveller_id' => 6,
        ));
        DB::table('transport_traveller')->insert(array(
            'transport_id' => 1,
            'traveller_id' => 7,
        ));
        DB::table('transport_traveller')->insert(array(
            'transport_id' => 1,
            'traveller_id' => 8,
        ));
        DB::table('transport_traveller')->insert(array(
            'transport_id' => 1,
            'traveller_id' => 9,
        ));
        DB::table('transport_traveller')->insert(array(
            'transport_id' => 2,
            'traveller_id' => 11,
        ));
        DB::table('transport_traveller')->insert(array(
            'transport_id' => 2,
            'traveller_id' => 12,
        ));
        DB::table('transport_traveller')->insert(array(
            'transport_id' => 2,
            'traveller_id' => 13,
        ));
        DB::table('transport_traveller')->insert(array(
            'transport_id' => 2,
            'traveller_id' => 14,
        ));
        DB::table('transport_traveller')->insert(array(
            'transport_id' => 2,
            'traveller_id' => 15,
        ));
        DB::table('transport_traveller')->insert(array(
            'transport_id' => 2,
            'traveller_id' => 16,
        ));
        DB::table('transport_traveller')->insert(array(
            'transport_id' => 3,
            'traveller_id' => 18,
        ));
        DB::table('transport_traveller')->insert(array(
            'transport_id' => 3,
            'traveller_id' => 19,
        ));
        DB::table('transport_traveller')->insert(array(
            'transport_id' => 3,
            'traveller_id' => 20,
        ));
        DB::table('transport_traveller')->insert(array(
            'transport_id' => 3,
            'traveller_id' => 21,
        ));
    }
}
