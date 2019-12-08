<?php

use Illuminate\Database\Seeder;

class TransportTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('transports')->insert(array(
            'trip_id' => 1,
            'driver_id' => 1,
            'size' => 10,
        ));
        DB::table('transports')->insert(array(
            'trip_id' => 1,
            'driver_id' => 2,
            'size' => 10,
        ));
    }
}
