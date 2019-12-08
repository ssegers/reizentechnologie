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
        // activiteiten dag 4
        DB::table('activities')->insert(array(
            'day_planning_id' => 4,
            'name' => 'Bedrijfsbezoeken',
            'start_hour' => '08:30',
            "end_hour" => '12:00',
            'description' => 'bezoek aan Facebook Like Sign, Google garage, Original Hewlett Packard Garage',
            'location' => 'USS Hornet Museum, 707 W Hornet Ave, Alameda, CA 94501'
        ));
        DB::table('activities')->insert(array(
            'day_planning_id' => 4,
            'name' => 'Jelly Beans',
            'start_hour' => '13:00',
            "end_hour" => '16:00',
            'description' => 'bezoek aan fabriek Jelly Belly van de gekende Jelly Beans',
            'location' => 'Jelly Belly, 1 Jelly Belly Ln, Fairfield, CA 94533'
        ));
        // activiteiten dag 5
        DB::table('activities')->insert(array(
            'day_planning_id' => 5,
            'name' => 'Raften',
            'start_hour' => '07:30',
            "end_hour" => '16:00',
            'description' => 'Afvaart van de Middle Fork American River',
            'location' => 'American Whitewater, 6019 New River Road, Coloma, CA 95613'
        ));
        // activiteiten dag 6
        DB::table('activities')->insert(array(
            'day_planning_id' => 6,
            'name' => 'Yosemite Park',
            'start_hour' => '07:45',
            "end_hour" => '11:30',
            'description' => 'Tuolome grove Trailhead in Yosemite',
            'location' => 'American Whitewater, 6019 New River Road, Coloma, CA 95613'
        ));
        DB::table('activities')->insert(array(
            'day_planning_id' => 6,
            'name' => 'Yosemite Park',
            'start_hour' => '12:50',
            "end_hour" => '13:30',
            'description' => 'Rit naar Yosemite Village Lodge',
            'location' => 'Yosemite Village Visitor Center'
        ));
        DB::table('activities')->insert(array(
            'day_planning_id' => 6,
            'name' => 'Yosemite Park',
            'start_hour' => '13:30',
            "end_hour" => '15:00',
            'description' => 'Wandeling (2km) naar Lower Yosemite falls (98 meter hoge waterval)',
            'location' => 'Yosemite Village Visitor Center'
        ));
        DB::table('activities')->insert(array(
            'day_planning_id' => 6,
            'name' => 'Lone Pine',
            'start_hour' => '15:00',
            "end_hour" => '19:30',
            'description' => 'Rit naar Lone Pine met bezienswaardigheden',
            'location' => 'Comfort Inn Lone Pine1, 920 S Main Street, Lone Pine, CA 93545'
        ));
        // activiteiten dag 7
        DB::table('activities')->insert(array(
            'day_planning_id' => 7,
            'name' => 'Death Valley',
            'start_hour' => '08:15',
            "end_hour" => '17:30',
            'description' => 'Rit naar Las Vegas via Death Valley met een paar uitstappen',
            'location' => 'American Whitewater, 6019 New River Road, Coloma, CA 95613'
        ));
        // activiteiten dag 8
        DB::table('activities')->insert(array(
            'day_planning_id' => 8,
            'name' => 'Las Vegas',
            'start_hour' => '09:00',
            "end_hour" => '17:30',
            'description' => 'Keuzeuitstap: Bezoek aan Valley of Fire of naar de Hooverdam',
            'location' => 'Las Vegas'
        ));
        // activiteiten dag 9
        DB::table('activities')->insert(array(
            'day_planning_id' => 9,
            'name' => 'Los Angeles',
            'start_hour' => '09:00',
            "end_hour" => '11:30',
            'description' => 'Rit van Las Vegas naar Los Angeles langs stuk van route 66',
            'location' => 'Las Vegas'
        ));
        DB::table('activities')->insert(array(
            'day_planning_id' => 9,
            'name' => 'Museum route 66',
            'start_hour' => '12:15',
            "end_hour" => '13:15',
            'description' => 'Bezoek aan Museum van Route 66',
            'location' => 'Californië Route 66 Museum,16825 South D Street,Victorville CA, 92395'
        ));
        DB::table('activities')->insert(array(
            'day_planning_id' => 9,
            'name' => 'Venice Beach',
            'start_hour' => '15:30',
            "end_hour" => '18:00',
            'description' => 'Bezoek aan Venice Beach en incheck hotel',
            'location' => 'Hampton Inn & Suites LAX El Segundo, 888 N Sepulveda Blvd, El Segundo, CA 90245'
        ));
        // activiteiten dag 10
        DB::table('activities')->insert(array(
            'day_planning_id' => 10,
            'name' => 'Hollywood',
            'start_hour' => '08:00',
            "end_hour" => '11:30',
            'description' => 'Bezoek aan de Hollywood Studios',
            'location' => 'Universal Studios Hollywood, Universal City, Los Angeles'
        ));
        // activiteiten dag 10
        DB::table('activities')->insert(array(
            'day_planning_id' => 11,
            'name' => 'Terugvlucht',
            'start_hour' => '05:45',
            "end_hour" => '16:21',
            'description' => 'Vliegreis Los Angeles-Newark',
            'location' => 'Luchthaven Los Angeles'
        ));
        DB::table('activities')->insert(array(
            'day_planning_id' => 11,
            'name' => 'Terugvlucht',
            'start_hour' => '18:25',
            "end_hour" => '07:45',
            'description' => 'Vliegreis Newark-Brussels',
            'location' => 'Newark National Airport'
        ));
    }
}
