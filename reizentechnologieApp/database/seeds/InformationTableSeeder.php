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
            'info_value' => "<ul><li><b>Je internationaal paspoort of reispas is zonder enige twijfel het ALLERBELANGRIJKSTE document dat je voor je vlucht en van en naar de VS en ook ter plaatse nodig hebt. Het verliezen van je reispas in de VS is een enorm probleem!!! Draag dus zorg voor dit document!</b></li><li>Als je elektrische apparaten (batterijlader, scheerapparaat, lader  GSM,...) wil gebruiken in de VS moet je er rekening mee houden dat men daar een spanning van 110 Volt (frequentie 60 Hz) heeft. De meeste apparaten werken wel, maar bv. het laden van de batterijen duurt wat langer. Voorzie wel een <b>Amerikaanse stekker</b> (omvormer met platte pennen) om je Europese apparaten te kunnen gebruiken. Voorzie eventueel ook een <b>verdeelstekker</b> omdat sommige hotelkamers een beperkt aantal stopcontacten hebben.</li><li>De GSM-nummers van docenten: Koen Haagdorens (+32 472 881954), Stefan Segers (+32 494 082031), Bart Smeets (+32 479 378802) en Bart Vandervoort (+32 479 936213) kan je gebruiken bij noodgevallen of problemen als we nog in België zijn. In de VS zullen we via Amerikaanse GSM-nummers te bereiken zijn.</li><li>Op het einde van deze bundel vind je een <b>overzicht van onze hotels in de VS en de GSM-nummers van de docentenen de externe begeleiders</b> die de reis begeleiden. Verder zijn  ook alle GSM-nummers van de studenten opgenomen. Deze lijsten heb je best altijd bij de hand.</li></ul>",
        ]);
    }
}
