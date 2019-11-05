<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Standaard Gebruiker
        DB::table('users')->insert([
            'username' => 'guest',
            'password' => bcrypt('123456'),
            'role' => 'guest',
            'api_token' => Str::random(60),
        ]);

        // Admin
        DB::table('users')->insert([
            'username' => 'admin',
            'password' => bcrypt('admin'),
            'role' => 'admin',
            'api_token' => Str::random(60),
        ]);


        // Stefan Segers
        DB::table('users')->insert([
            'username' => 'u0598673',
            'password' => bcrypt('stefan'),
            'role' => 'guide',
            'api_token' => Str::random(60),
        ]);

        // Rudi Roox
        DB::table('users')->insert([
            'username' => 'u0569802',
            'password' => bcrypt('rudi'),
            'role' => 'guide',
            'api_token' => Str::random(60),
        ]);

        // Daan Vandebosch
        DB::table('users')->insert([
            'username' => 'test',
            'password' => bcrypt('test'),
            'role' => 'traveller',
            'api_token' => Str::random(60),
        ]);

        // Kaan Akpinar
        DB::table('users')->insert([
            'username' => 'r0577574',
            'password' => bcrypt('kaan'),
            'role' => 'traveller',
            'api_token' => Str::random(60),
        ]);

        // Joren Meynen
        DB::table('users')->insert([
            'username' => 'r0233215',
            'password' => bcrypt('joren'),
            'role' => 'traveller',
            'api_token' => Str::random(60),
        ]);

        // Michiel Guilliams
        DB::table('users')->insert([
            'username' => 'r0668515',
            'password' => bcrypt('michiel'),
            'role' => 'traveller',
            'api_token' => Str::random(60),
        ]);

        // Nicolaas Schelfhout
        DB::table('users')->insert([
            'username' => 'r0679934',
            'password' => bcrypt('nicolaas'),
            'role' => 'traveller',
            'api_token' => Str::random(60),
        ]);

        // Robin Machiels
        DB::table('users')->insert([
            'username' => 'r0664407',
            'password' => bcrypt('robin'),
            'role' => 'traveller',
            'api_token' => Str::random(60),
        ]);

        // Sasha Van De Voorde
        DB::table('users')->insert([
            'username' => 'r0673786',
            'password' => bcrypt('sasha'),
            'role' => 'traveller',
            'api_token' => Str::random(60),
        ]);

        // Stef Kerkhofs
        DB::table('users')->insert([
            'username' => 'r0658314',
            'password' => bcrypt('stef'),
            'role' => 'traveller',
            'api_token' => Str::random(60),
        ]);

        // Yoeri op't Roodt
        DB::table('users')->insert([
            'username' => 'r0663911',
            'password' => bcrypt('yoeri'),
            'role' => 'traveller',
            'api_token' => Str::random(60),
        ]);


        // Jan Modaal
        DB::table('users')->insert([
            'username' => 'r1234567',
            'password' => bcrypt('jan'),
            'role' => 'traveller',
            'api_token' => Str::random(60),
        ]);


        //Piet Janssen
        DB::table('users')->insert([
            'username' => 'r7891011',
            'password' => bcrypt('piet'),
            'role' => 'traveller',
            'api_token' => Str::random(60),
        ]);

        //Toon Peters
        DB::table('users')->insert([
            'username' => 'r1112131',
            'password' => bcrypt('toon'),
            'role' => 'traveller',
            'api_token' => Str::random(60),
        ]);

        //Gert Nullens
        DB::table('users')->insert([
            'username' => 'r1415161',
            'password' => bcrypt('gert'),
            'role' => 'traveller',
            'api_token' => Str::random(60),
        ]);

        //Bram Bongers
        DB::table('users')->insert([
            'username' => 'r1718192',
            'password' => bcrypt('bram'),
            'role' => 'traveller',
            'api_token' => Str::random(60),
        ]);

        //Tom Moons
        DB::table('users')->insert([
            'username' => 'r2021222',
            'password' => bcrypt('tom'),
            'role' => 'traveller',
            'api_token' => Str::random(60),
        ]);

        //Jens Janssen
        DB::table('users')->insert([
            'username' => 'r2324252',
            'password' => bcrypt('jens'),
            'role' => 'traveller',
            'api_token' => Str::random(60),
        ]);

        //Martijn Theunissen
        DB::table('users')->insert([
            'username' => 'r2627282',
            'password' => bcrypt('martijn'),
            'role' => 'traveller',
            'api_token' => Str::random(60),
        ]);

        //Steve Stevens
        DB::table('users')->insert([
            'username' => 'r2930313',
            'password' => bcrypt('steve'),
            'role' => 'traveller',
            'api_token' => Str::random(60),
        ]);

        //Dario Thielens
        DB::table('users')->insert([
            'username' => 'r3233343',
            'password' => bcrypt('dario'),
            'role' => 'traveller',
            'api_token' => Str::random(60),
        ]);

        //Bert Bertens
        DB::table('users')->insert([
            'username' => 'r3536373',
            'password' => bcrypt('bert'),
            'role' => 'traveller',
            'api_token' => Str::random(60),
        ]);

        //Piet Pieters
        DB::table('users')->insert([
            'username' => 'r3839404',
            'password' => bcrypt('piet'),
            'role' => 'traveller',
            'api_token' => Str::random(60),
        ]);

        //Rudy Verboven
        DB::table('users')->insert([
            'username' => 'r4142434',
            'password' => bcrypt('rudy'),
            'role' => 'traveller',
            'api_token' => Str::random(60),
        ]);

        //Johnny Bravo
        DB::table('users')->insert([
            'username' => 'r4445464',
            'password' => bcrypt('johnny'),
            'role' => 'traveller',
            'api_token' => Str::random(60),
        ]);

        //Bjorn Mertens
        DB::table('users')->insert([
            'username' => 'r4748495',
            'password' => bcrypt('bjorn'),
            'role' => 'traveller',
            'api_token' => Str::random(60),
        ]);

        //Jan Tomassen
        DB::table('users')->insert([
            'username' => 'r5051525',
            'password' => bcrypt('jan'),
            'role' => 'traveller',
            'api_token' => Str::random(60),
        ]);

        //Vincent Ramaekers
        DB::table('users')->insert([
            'username' => 'r5354555',
            'password' => bcrypt('vincent'),
            'role' => 'traveller',
            'api_token' => Str::random(60),
        ]);

        //Glenn Vanaken
        DB::table('users')->insert([
            'username' => 'r5657585',
            'password' => bcrypt('glenn'),
            'role' => 'traveller',
            'api_token' => Str::random(60),
        ]);

        //Roel Aegten
        DB::table('users')->insert([
            'username' => 'r5960616',
            'password' => bcrypt('roel'),
            'role' => 'traveller',
            'api_token' => Str::random(60),
        ]);




        //More Dummy Data
        DB::table('users')->insert([
            'username' => 'r0000032',
            'password' => bcrypt('0000032'),
            'role' => 'traveller',
            'api_token' => Str::random(60),
        ]);
        DB::table('users')->insert([
            'username' => 'r0000033',
            'password' => bcrypt('0000033'),
            'role' => 'traveller',
            'api_token' => Str::random(60),
        ]);
        DB::table('users')->insert([
            'username' => 'r0000034',
            'password' => bcrypt('0000034'),
            'role' => 'traveller',
            'api_token' => Str::random(60),
        ]);
        DB::table('users')->insert([
            'username' => 'r0000035',
            'password' => bcrypt('0000035'),
            'role' => 'traveller',
            'api_token' => Str::random(60),
        ]);
        DB::table('users')->insert([
            'username' => 'r0000036',
            'password' => bcrypt('0000036'),
            'role' => 'traveller',
            'api_token' => Str::random(60),
        ]);
        DB::table('users')->insert([
            'username' => 'r0000037',
            'password' => bcrypt('0000037'),
            'role' => 'traveller',
            'api_token' => Str::random(60),
        ]);
        DB::table('users')->insert([
            'username' => 'r0000038',
            'password' => bcrypt('0000038'),
            'role' => 'traveller',
            'api_token' => Str::random(60),
        ]);
        DB::table('users')->insert([
            'username' => 'r0000039',
            'password' => bcrypt('0000039'),
            'role' => 'traveller',
            'api_token' => Str::random(60),
        ]);
        DB::table('users')->insert([
            'username' => 'r0000040',
            'password' => bcrypt('0000040'),
            'role' => 'guide',
            'api_token' => Str::random(60),
        ]);
        DB::table('users')->insert([
            'username' => 'r0000041',
            'password' => bcrypt('0000041'),
            'role' => 'guide',
            'api_token' => Str::random(60),
        ]);
        DB::table('users')->insert([
            'username' => 'r0000042',
            'password' => bcrypt('0000042'),
            'role' => 'guide',
            'api_token' => Str::random(60),
        ]);
        DB::table('users')->insert([
            'username' => 'r0000043',
            'password' => bcrypt('0000043'),
            'role' => 'guide',
            'api_token' => Str::random(60),
        ]);
        DB::table('users')->insert([
            'username' => 'r0000044',
            'password' => bcrypt('0000044'),
            'role' => 'guide',
            'api_token' => Str::random(60),
        ]);
        DB::table('users')->insert([
            'username' => 'r0000045',
            'password' => bcrypt('0000045'),
            'role' => 'guide',
            'api_token' => Str::random(60),
        ]);
        DB::table('users')->insert([
            'username' => 'r0000046',
            'password' => bcrypt('0000046'),
            'role' => 'guide',
            'api_token' => Str::random(60),
        ]);
        DB::table('users')->insert([
            'username' => 'r0000047',
            'password' => bcrypt('0000047'),
            'role' => 'guide',
            'api_token' => Str::random(60),
        ]);
        DB::table('users')->insert([
            'username' => 'r0000048',
            'password' => bcrypt('0000048'),
            'role' => 'guide',
            'api_token' => Str::random(60),
        ]);
        DB::table('users')->insert([
            'username' => 'r0000049',
            'password' => bcrypt('0000049'),
            'role' => 'guide',
            'api_token' => Str::random(60),
        ]);
        DB::table('users')->insert([
            'username' => 'r0000050',
            'password' => bcrypt('0000050'),
            'role' => 'guide',
            'api_token' => Str::random(60),
        ]);
    }
}
