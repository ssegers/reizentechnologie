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
        )); // id 1
        DB::table('activities')->insert(array(
            'name' => 'inchecken hotel',
            'description' => 'inchecken in het hotel, daarna vrije avond',
            'location' => '20 Airport Blvd South San Francisco CA 94080'
        )); // id 2

        // activiteiten dag 2
        DB::table('activities')->insert(array(
            'name' => 'Bezoek Alcatraz',
            'description' => 'Bezoek aan Alcatraz, de gevangenis op het eiland, ookwel de Rock genoemd',
            'location' => 'Pier 33'
        )); // id 3
        DB::table('activities')->insert(array(
            'name' => '49 miles scenic drive',
            'description' => 'rondrit doorheen San Francisco, bezoek aan diverse bezienswaardigheden zoals: Golden Gate Bridge, Twitter, Cable Car Museum, Lombard Street.',
            'location' => 'San Fransisco'
        )); // id 4

        // activiteiten dag 3
        DB::table('activities')->insert(array(
            'name' => 'Bedrijfsbezoeken',
            'description' => 'bezoek aan Facebook Like Sign, Google garage, Original Hewlett Packard Garage',
            'location' => 'Silicon Valley'
        )); // id 5
        DB::table('activities')->insert(array(
            'name' => 'Bezoek Standford University',
            'description' => 'rondleiding en eten',
            'location' => 'Standford University'
        )); // id 6
        DB::table('activities')->insert(array(
            'name' => 'vervolg bedrijfsbezoeken',
            'description' => 'Bezoek aan Google Plex, Android Sculpture Garden, Intel Museum, Apple\'s Company Store and Headquarters, ...',
            'location' => 'Silicon Valley'
        )); // id 7
        
        // activiteiten dag 4
        DB::table('activities')->insert(array(
            'name' => 'USS Hornet Museum',
            'description' => 'bezoek aan het USS Hornet museum',
            'location' => 'USS Hornet Museum, 707 W Hornet Ave, Alameda, CA 94501'
        )); // id 8
        DB::table('activities')->insert(array(
            'name' => 'Jelly Beans',
            'description' => 'bezoek aan fabriek Jelly Belly van de gekende Jelly Beans',
            'location' => 'Jelly Belly, 1 Jelly Belly Ln, Fairfield, CA 94533'
        )); // id 9
        DB::table('activities')->insert(array(
            'name' => 'Vertrek naar camping',
            'description' => 'vertrek naar de camping en inchecken op de camping, daarna vrije avond',
            'location' => 'Jelly Belly, 1 Jelly Belly Ln, Fairfield, CA 94533'
        )); // id 10
        
        // activiteiten dag 5
        DB::table('activities')->insert(array(
            'name' => 'Raften',
            'description' => 'Afvaart van de Middle Fork American River',
            'location' => 'American Whitewater, 6019 New River Road, Coloma, CA 95613'
        )); // id 11
        DB::table('activities')->insert(array(
            'name' => 'avondmaal',
            'description' => 'avondmaal is voorzien op de camping',
            'location' => 'American Whitewater, 6019 New River Road, Coloma, CA 95613'
        )); // id 12
        
        // activiteiten dag 6
        DB::table('activities')->insert(array(
            'name' => 'Yosemite Park',
            'description' => 'Tuolome grove Trailhead in Yosemite',
            'location' => 'American Whitewater, 6019 New River Road, Coloma, CA 95613'
        )); // id 13
        DB::table('activities')->insert(array(
            'name' => ' Tuolome grove Trailhead',
            'description' => 'Rit naar Yosemite Village Lodge',
            'location' => 'Yosemite Village Visitor Center'
        )); // id 14
        DB::table('activities')->insert(array(
            'name' => 'Yosemite Village Lodge',
            'description' => 'Wandeling (2km) naar Lower Yosemite falls (98 meter hoge waterval)',
            'location' => 'Yosemite Village Visitor Center'
        )); // id 15
        DB::table('activities')->insert(array(
            'name' => 'Lone Pine',
            'description' => 'Rit naar Lone Pine met bezienswaardigheden, onderweg wordt er gegeten, inchekken in hotel, daarna vrije avond',
            'location' => 'Comfort Inn Lone Pine1, 920 S Main Street, Lone Pine, CA 93545'
        )); // id 16
        
        // activiteiten dag 7
        DB::table('activities')->insert(array(
            'name' => 'Death Valley',
            'description' => 'Rit naar Las Vegas via Death Valley met een paar uitstappen, \'s vrije avond',
            'location' => 'American Whitewater, 6019 New River Road, Coloma, CA 95613'
        )); // id 17
        
        // activiteiten dag 8
        DB::table('activities')->insert(array(
            'name' => 'Las Vegas',
            'description' => 'Keuzeuitstap: Bezoek aan Valley of Fire of naar de Hooverdam',
            'location' => 'Las Vegas'
        )); // id 18
        DB::table('activities')->insert(array(
            'name' => 'vrije namiddag',
            'description' => 'je bent vrij om te doen wat je wil, ja kan de strip bezoeken of wat gaan shoppen',
            'location' => 'Las Vegas Strip'
        )); // id 19
        DB::table('activities')->insert(array(
            'name' => 'Avondeten Pampas Brazilian Grille',
            'description' => 'samenkomst aan het hotel, voor deze avond is het avondeten gepland in het Pampas Brazilian Grille restaurant',
            'location' => '3663 Las Vegas South, Ste 610 Las Vegas NV 89109'
        )); // id 20

        // activiteiten dag 9
        DB::table('activities')->insert(array(
            'name' => 'Rit naar Los Angeles',
            'description' => 'Rit van Las Vegas naar Los Angeles langs stuk van route 66',
            'location' => 'Las Vegas'
        )); // id 21
        DB::table('activities')->insert(array(
            'name' => 'Museum route 66',
            'description' => 'Bezoek aan Museum van Route 66',
            'location' => 'Californië Route 66 Museum,16825 South D Street,Victorville CA, 92395'
        )); // id 22
        DB::table('activities')->insert(array(
            'name' => 'Vervolg rit naar Los Angeles',
            'description' => 'Rit van Las Vegas naar Los Angeles',
            'location' => 'Las Vegas'
        )); // id 23
        DB::table('activities')->insert(array(
            'name' => 'Venice Beach',
            'description' => 'Bezoek aan Venice Beach en incheck hotel',
            'location' => 'Venice Beach'
        )); // id 24
        DB::table('activities')->insert(array(
            'name' => 'Inchecken hotel',
            'description' => 'Inchecken in het hotel, vrije avond, je moet zelf voor je avondeten zorgen',
            'location' => '888 N Sepulveda Blvd El Segundo, CA 90245'
        )); // id 25
        
        // activiteiten dag 10
        DB::table('activities')->insert(array(
            'name' => 'Hollywood',
            'description' => 'Bezoek aan de Hollywood Studios',
            'location' => 'Universal Studios Hollywood, Universal City, Los Angeles'
        )); // id 26
        DB::table('activities')->insert(array(
            'name' => 'Avondeten & vrije avond',
            'description' => 'je krijgt ook deze avond 20$ voor je avendeten, daarna ben je vrij',
            'location' => 'City Walk Hard-rock café'
        )); // id 27
        
        // activiteiten dag 11
        DB::table('activities')->insert(array(
            'name' => 'Terugvlucht',
            'description' => 'Vliegreis Los Angeles-Newark',
            'location' => 'Luchthaven Los Angeles'
        )); // id 28
        DB::table('activities')->insert(array(
            'name' => 'Terugvlucht',
            'description' => 'Vliegreis Newark-Brussels',
            'location' => 'Newark National Airport'
        )); // id 29
    }
}
