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
            'name' => 'Heen vlucht',
            'description' => 'Vlucht van Brussel naar Amerika',
            'location' => 'Brussel National Airport'
        ));
        DB::table('activities')->insert(array(
            'name' => 'inchecken hotel',
            'description' => 'We are going to visit a company',
            'location' => '20 Airport Blvd South San Francisco CA 94080'
        ));

        // activiteiten dag 2
        DB::table('activities')->insert(array(
            'name' => 'Bezoek Alcatraz',
            'description' => 'Bezoek aan de gevangenis op het eiland',
            'location' => 'Pier 33'
        ));
        DB::table('activities')->insert(array(
            'name' => '49 miles scenic drive',
            'description' => 'rondrit doorheen San Francisco, bezoek aan diverse bezienswaardigheden zoals: Golden Gate Bridge, Twitter, Cable Car Museum, Lombard Street.',
            'location' => 'San Fransisco'
        ));

        // activiteiten dag 3
        DB::table('activities')->insert(array(
            'name' => 'Bedrijfsbezoeken',
            'description' => 'bezoek aan Facebook Like Sign, Google garage, Original Hewlett Packard Garage',
            'location' => 'Silicon Valley'
        ));
        DB::table('activities')->insert(array(
            'name' => 'Bezoek Standford University',
            'description' => 'rondleiding en eten',
            'location' => 'Standford University'
        ));
        DB::table('activities')->insert(array(
            'name' => 'vervolg bedrijfsbezoeken',
            'description' => 'Bezoek aan Google Plex, Android Sculpture Garden, Intel Museum, Apple\'s Company Store and Headquarters, ...',
            'location' => 'Silicon Valley'
        ));
        
        // activiteiten dag 4
        DB::table('activities')->insert(array(
            'name' => 'USS Hornet Museum',
            'description' => 'bezoek aan het USS Hornet museum',
            'location' => 'USS Hornet Museum, 707 W Hornet Ave, Alameda, CA 94501'
        ));
        DB::table('activities')->insert(array(
            'name' => 'Jelly Beans',
            'description' => 'bezoek aan fabriek Jelly Belly van de gekende Jelly Beans',
            'location' => 'Jelly Belly, 1 Jelly Belly Ln, Fairfield, CA 94533'
        ));
        
        // activiteiten dag 5
        DB::table('activities')->insert(array(
            'name' => 'Raften',
            'description' => 'Afvaart van de Middle Fork American River',
            'location' => 'American Whitewater, 6019 New River Road, Coloma, CA 95613'
        ));
        
        // activiteiten dag 6
        DB::table('activities')->insert(array(
            'name' => 'Yosemite Park',
            'description' => 'Tuolome grove Trailhead in Yosemite',
            'location' => 'American Whitewater, 6019 New River Road, Coloma, CA 95613'
        ));
        DB::table('activities')->insert(array(
            'name' => 'Yosemite Park',
            'description' => 'Rit naar Yosemite Village Lodge',
            'location' => 'Yosemite Village Visitor Center'
        ));
        DB::table('activities')->insert(array(
            'name' => 'Yosemite Park',
            'description' => 'Wandeling (2km) naar Lower Yosemite falls (98 meter hoge waterval)',
            'location' => 'Yosemite Village Visitor Center'
        ));
        DB::table('activities')->insert(array(
            'name' => 'Lone Pine',
            'description' => 'Rit naar Lone Pine met bezienswaardigheden',
            'location' => 'Comfort Inn Lone Pine1, 920 S Main Street, Lone Pine, CA 93545'
        ));
        
        // activiteiten dag 7
        DB::table('activities')->insert(array(
            'name' => 'Death Valley',
            'description' => 'Rit naar Las Vegas via Death Valley met een paar uitstappen',
            'location' => 'American Whitewater, 6019 New River Road, Coloma, CA 95613'
        ));
        
        // activiteiten dag 8
        DB::table('activities')->insert(array(
            'name' => 'Las Vegas',
            'description' => 'Keuzeuitstap: Bezoek aan Valley of Fire of naar de Hooverdam',
            'location' => 'Las Vegas'
        ));
        // activiteiten dag 9
        DB::table('activities')->insert(array(
            'name' => 'Los Angeles',
            'description' => 'Rit van Las Vegas naar Los Angeles langs stuk van route 66',
            'location' => 'Las Vegas'
        ));
        DB::table('activities')->insert(array(
            'name' => 'Museum route 66',
            'description' => 'Bezoek aan Museum van Route 66',
            'location' => 'Californië Route 66 Museum,16825 South D Street,Victorville CA, 92395'
        ));
        DB::table('activities')->insert(array(
            'name' => 'Venice Beach',
            'description' => 'Bezoek aan Venice Beach en incheck hotel',
            'location' => 'Hampton Inn & Suites LAX El Segundo, 888 N Sepulveda Blvd, El Segundo, CA 90245'
        ));
        
        // activiteiten dag 10
        DB::table('activities')->insert(array(
            'name' => 'Hollywood',
            'description' => 'Bezoek aan de Hollywood Studios',
            'location' => 'Universal Studios Hollywood, Universal City, Los Angeles'
        ));
        
        // activiteiten dag 11
        DB::table('activities')->insert(array(
            'name' => 'Terugvlucht',
            'description' => 'Vliegreis Los Angeles-Newark',
            'location' => 'Luchthaven Los Angeles'
        ));
        DB::table('activities')->insert(array(
            'name' => 'Terugvlucht',
            'description' => 'Vliegreis Newark-Brussels',
            'location' => 'Newark National Airport'
        ));
    }
}
