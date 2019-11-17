<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActivitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('activities')->insert(array(
            'day_planning_id' => 1,
            'name' => 'Big Apple',
            'start_hour' => '09:00',
            "end_hour" => '12:00',
            'description' => 'We are going to visit the Big Apple',
            'location' => 'New York'
        ));
        DB::table('activities')->insert(array(
            'day_planning_id' => 1,
            'name' => 'Company visit a',
            'start_hour' => '13:00',
            "end_hour" => '15:00',
            'description' => 'We are going to visit a company',
            'location' => 'New York'
        ));
        DB::table('activities')->insert(array(
            'day_planning_id' => 1,
            'name' => 'Company visit b',
            'start_hour' => '16:00',
            "end_hour" => '18:00',
            'description' => 'We are going to visit a company',
            'location' => 'New York'
        ));
        DB::table('activities')->insert(array(
            'day_planning_id' => 2,
            'name' => 'Statue of Liberty',
            'start_hour' => '09:00',
            "end_hour" => '12:00',
            'description' => 'We are going to visit the Statue of Liberty',
            'location' => 'New York'
        ));
        DB::table('activities')->insert(array(
            'day_planning_id' => 2,
            'name' => 'Company visit a',
            'start_hour' => '13:00',
            "end_hour" => '15:00',
            'description' => 'We are going to visit a company',
            'location' => 'New York'
        ));
        DB::table('activities')->insert(array(
            'day_planning_id' => 2,
            'name' => 'Company visit b',
            'start_hour' => '16:00',
            "end_hour" => '18:00',
            'description' => 'We are going to visit a company',
            'location' => 'New York'
        ));
        DB::table('activities')->insert(array(
            'day_planning_id' => 3,
            'name' => 'Washinton Monument',
            'start_hour' => '09:00',
            "end_hour" => '12:00',
            'description' => 'We are going to visit the Washinton Monument',
            'location' => 'Washinton DC'
        ));
        DB::table('activities')->insert(array(
            'day_planning_id' => 3,
            'name' => 'Company visit a',
            'start_hour' => '13:00',
            "end_hour" => '15:00',
            'description' => 'We are going to visit a company',
            'location' => 'Washinton DC'
        ));
        DB::table('activities')->insert(array(
            'day_planning_id' => 3,
            'name' => 'Company visit b',
            'start_hour' => '16:00',
            "end_hour" => '18:00',
            'description' => 'We are going to visit a company',
            'location' => 'Washinton DC'
        ));
    }
}
