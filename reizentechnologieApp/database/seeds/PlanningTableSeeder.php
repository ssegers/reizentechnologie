<?php

use Illuminate\Database\Seeder;

class PlanningTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('plannings')->insert(array(
            'activity_id' => 1,
            'day_id' => 1,
            'start_hour' => '07:00',
            'end_hour' => '23:59'
        ));
    }
}
