<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DayPlanningSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('day_plannings')->insert(array(
            'trip_id' => 1,
            'date' => '2020/05/18',
            'highlight' => 'Big Apple',
            'description' => 'We are going to visit the Big Apple',
            'location' => 'New York'
        ));
        DB::table('day_plannings')->insert(array(
            'trip_id' => 1,
            'date' => '2020/05/19',
            'highlight' => 'Statue of Liberty',
            'description' => 'We are going to visit the Statue of Liberty',
            'location' => 'New York'
        ));
        DB::table('day_plannings')->insert(array(
            'trip_id' => 2,
            'date' => '2020/05/20',
            'highlight' => 'Washington Monument',
            'description' => 'We are going to visit the Washington Monument',
            'location' => 'Washington DC'
        ));
        
    }
}
