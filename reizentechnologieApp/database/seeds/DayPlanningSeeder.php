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
            'date' => '2020/05/21',
            'highlight' => 'Brussel National Airport',
            'description' => 'Vertrek naar Amerika',
            'location' => 'Brussel'
        ));
        DB::table('day_plannings')->insert(array(
            'trip_id' => 1,
            'date' => '2020/05/22',
            'highlight' => 'Alcatraz',
            'description' => 'Bezoek aan Alcatraz, de gevangenis op het eiland',
            'location' => 'San Francisco'
        ));
        DB::table('day_plannings')->insert(array(
            'trip_id' => 1,
            'date' => '2020/05/23',
            'highlight' => 'Rondrit Silicon Valley',
            'description' => 'Rondrit door Silicon Valley, we passeren enkele grote bedrijven gelijk Google, Intel, Stanford University',
            'location' => 'Silicon Valley'
        ));
        
    }
}
