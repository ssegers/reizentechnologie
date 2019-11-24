<?php

use Illuminate\Database\Seeder;

class InformationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('information')->insert([
            'info_name' => 'algemene_voorwaarde',
            'info_value' => "dit is de algemene voorwaarde die je moet goedkeuren voordat je de app kan gebruiken.",
        ]);
        DB::table('information')->insert([
            'info_name' => 'algemene_info',
            'info_value' => "dit is de algemene info van onze app, hier vind je meer informatie over de reis.",
        ]);
    }
}
