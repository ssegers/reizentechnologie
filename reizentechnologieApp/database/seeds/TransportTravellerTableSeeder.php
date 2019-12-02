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
            'traveller_id' => 6,
        ));
        DB::table('transport_traveller')->insert(array(
            'transport_id' => 1,
            'traveller_id' => 8,
        ));
        DB::table('transport_traveller')->insert(array(
            'transport_id' => 1,
            'traveller_id' => 10,
        ));
        DB::table('transport_traveller')->insert(array(
            'transport_id' => 1,
            'traveller_id' => 12,
        ));
        DB::table('transport_traveller')->insert(array(
            'transport_id' => 1,
            'traveller_id' => 14,
        ));
        DB::table('transport_traveller')->insert(array(
            'transport_id' => 1,
            'traveller_id' => 16,
        ));
        DB::table('transport_traveller')->insert(array(
            'transport_id' => 2,
            'traveller_id' => 18,
        ));
        DB::table('transport_traveller')->insert(array(
            'transport_id' => 2,
            'traveller_id' => 20,
        ));
        DB::table('transport_traveller')->insert(array(
            'transport_id' => 2,
            'traveller_id' => 22,
        ));
        DB::table('transport_traveller')->insert(array(
            'transport_id' => 2,
            'traveller_id' => 24,
        ));
        DB::table('transport_traveller')->insert(array(
            'transport_id' => 2,
            'traveller_id' => 26,
        ));
        DB::table('transport_traveller')->insert(array(
            'transport_id' => 2,
            'traveller_id' => 28,
        ));
        DB::table('transport_traveller')->insert(array(
            'transport_id' => 3,
            'traveller_id' => 30,
        ));
        DB::table('transport_traveller')->insert(array(
            'transport_id' => 3,
            'traveller_id' => 32,
        ));
        DB::table('transport_traveller')->insert(array(
            'transport_id' => 3,
            'traveller_id' => 34,
        ));
        DB::table('transport_traveller')->insert(array(
            'transport_id' => 3,
            'traveller_id' => 36,
        ));
    }
}
