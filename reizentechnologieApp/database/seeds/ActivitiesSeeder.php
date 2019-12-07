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
        // activiteiten dag 1
        DB::table('activities')->insert(array(
            'day_planning_id' => 1,
            'name' => 'Heen vlucht',
            'start_hour' => '07:00',
            "end_hour" => '23:59',
            'description' => 'Vlucht van Brussel naar Amerika',
            'location' => 'Brussel National Airport'
        ));
        DB::table('activities')->insert(array(
            'day_planning_id' => 1,
            'name' => 'inchecken hotel',
            'start_hour' => '13:00',
            "end_hour" => '15:00',
            'description' => 'We are going to visit a company',
            'location' => '20 Airport Blvd South San Francisco CA 94080'
        ));

        // activiteiten dag 2
        DB::table('activities')->insert(array(
            'day_planning_id' => 2,
            'name' => 'Bezoek Alcatraz',
            'start_hour' => '07:15',
            "end_hour" => '12:00',
            'description' => 'Bezoek aan de gevangenis op het eiland',
            'location' => 'Pier 33'
        ));
        DB::table('activities')->insert(array(
            'day_planning_id' => 2,
            'name' => '49 miles scenic drive',
            'start_hour' => '13:00',
            "end_hour" => '18:30',
            'description' => 'rondrit doorheen San Francisco, bezoek aan diverse bezienswaardigheden zoals: Golden Gate Bridge, Twitter, Cable Car Museum, Lombard Street.',
            'location' => 'San Fransisco'
        ));

        // activiteiten dag 3
        DB::table('activities')->insert(array(
            'day_planning_id' => 3,
            'name' => 'Bedrijfsbezoeken',
            'start_hour' => '08:45',
            "end_hour" => '10:30',
            'description' => 'bezoek aan Facebook Like Sign, Google garage, Original Hewlett Packard Garage',
            'location' => 'Silicon Valley'
        ));
        DB::table('activities')->insert(array(
            'day_planning_id' => 3,
            'name' => 'Bezoek Standford University',
            'start_hour' => '10:30',
            "end_hour" => '12:30',
            'description' => 'rondleiding en eten',
            'location' => 'Standford University'
        ));
        DB::table('activities')->insert(array(
            'day_planning_id' => 3,
            'name' => 'vervolg bedrijfsbezoeken',
            'start_hour' => '12:30',
            "end_hour" => '18:30',
            'description' => 'Bezoek aan Google Plex, Android Sculpture Garden, Intel Museum, Apple\'s Company Store and Headquarters, ...',
            'location' => 'Silicon Valley'
        ));
    }
}
