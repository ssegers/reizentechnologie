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
            'number' => '123456789',
            'traveller_id' => 1,
        ));
        DB::table('emergency_numbers')->insert(array(
            'number' => '123456789',
            'traveller_id' => 2,
        ));
    }
}
