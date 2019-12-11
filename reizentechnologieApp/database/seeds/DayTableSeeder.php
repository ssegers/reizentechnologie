<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DaysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		//Dag 1 = ID 1
        DB::table('days')->insert(array(
            'trip_id' => 1,
            'date' => '2020/05/21',
            'highlight' => 'Brussel National Airport',
            'description' => 'Vertrek naar Amerika',
            'location' => 'Brussel'
        ));
		//Dag 2 = ID 2
        DB::table('days')->insert(array(
            'trip_id' => 1,
            'date' => '2020/05/22',
            'highlight' => 'Alcatraz',
            'description' => 'Bezoek aan Alcatraz, de gevangenis op het eiland',
            'location' => 'San Francisco'
        ));
		//Dag 3 = ID 3
        DB::table('days')->insert(array(
            'trip_id' => 1,
            'date' => '2020/05/23',
            'highlight' => 'Rondrit Silicon Valley',
            'description' => 'Rondrit door Silicon Valley, we passeren enkele grote bedrijven gelijk Google, Intel, Stanford University',
            'location' => 'Silicon Valley'
        ));
		//Dag 4 = ID 4
        DB::table('days')->insert(array(
            'trip_id' => 1,
            'date' => '2020/05/24',
            'highlight' => 'USS Hornet en Jelly Belly',
            'description' => 'Bezoek aan het vliegdekschip USS Hornet en het fabriek Jelly Beans',
            'location' => 'Alameda'
        ));
		//Dag 5 = ID 5
        DB::table('days')->insert(array(
            'trip_id' => 1,
            'date' => '2020/05/25',
            'highlight' => 'Middle Fork American River',
            'description' => 'Afvaart van de Middle Fork American River',
            'location' => 'Coloma'
        ));
		//Dag 6 = ID 6
        DB::table('days')->insert(array(
            'trip_id' => 1,
            'date' => '2020/05/26',
            'highlight' => 'Las Vegas 1',
            'description' => 'Tweedaagse rit naar Las Vegas via Yosemite en Lone Pine',
            'location' => 'Coloma'
        ));
		//Dag 7 = ID 7
        DB::table('days')->insert(array(
            'trip_id' => 1,
            'date' => '2020/05/27',
            'highlight' => 'Las Vegas 2',
            'description' => 'Tweedaagse rit naar Las Vegas via Death Valley',
            'location' => 'Las Vegas'
        ));
		//Dag 8 = ID 8
        DB::table('days')->insert(array(
            'trip_id' => 1,
            'date' => '2020/05/28',
            'highlight' => 'Bezoek aan Valley of Fire of naar de Hooverdam',
            'description' => 'Keuzeuitstap: Bezoek aan Valley of Fire of naar de Hooverdam',
            'location' => 'Las Vegas'
        ));
		//Dag 9 = ID 9
        DB::table('days')->insert(array(
            'trip_id' => 1,
            'date' => '2020/05/29',
            'highlight' => 'Los Angeles',
            'description' => 'Rit van Las Vegas naar Los Angeles via Route 66',
            'location' => 'Las Vegas'
        ));
		//Dag 10 = ID 10
        DB::table('days')->insert(array(
            'trip_id' => 1,
            'date' => '2020/05/30',
            'highlight' => 'Hollywood Studios',
            'description' => 'Bezoek aan de Hollywood Studios',
            'location' => 'Las Vegas'
        ));
		//Dag 11 = ID 11
        DB::table('days')->insert(array(
            'trip_id' => 1,
            'date' => '2020/05/31',
            'highlight' => 'Back Home',
            'description' => 'Terugreis naar België',
            'location' => 'Los Angeles'
        ));
    }
}
