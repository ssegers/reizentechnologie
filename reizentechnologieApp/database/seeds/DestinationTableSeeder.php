<?php

use Illuminate\Database\Seeder;

class DestinationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('destinations')->insert(array(
            'destination_name' => 'Amerika'
        ));
        
        DB::table('destinations')->insert(array(
            'destination_name' => 'Duitsland'
        ));
        
        DB::table('destinations')->insert(array(
            'destination_name' => 'China'
        ));
    }
}
