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
            'info_name' => 'algemeen',
            'info_value' => "dit is de algemene info van onze app, als je dit leest dan werkt de algemene info",
        ]);
    }
}
