<?php

use Illuminate\Database\Seeder;

class EmergencyNumbersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('emergency_numbers')->insert(array(
            'trip_id' => 1,
            'number' => '123456789',
            'first_name' => "Stefan",
            "last_name" => "Segers"
        ));
        DB::table('emergency_numbers')->insert(array(
            'trip_id' => 1,
            'number' => '123456789',
            'first_name' => "Rudi",
            "last_name" => "Roox"
        ));
    }
}
