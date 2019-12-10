<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
        $this->call([ 
            PagesTableSeeder::class,
            UsersTableSeeder::class,
            TripsTableSeeder::class,
            StudiesTableSeeder::class,
            MajorsTableSeeder::class,
            ZipTableSeeder::class,
            TravellersTableSeeder::class,
            TravellerTripSeeder::class,
            InformationTableSeeder::class,
            HotelsSeeder::class,
            HotelTripSeeder::class,
            TransportTableSeeder::class,
            TransportTravellerTableSeeder::class,
            DayPlanningSeeder::class,
            ActivitiesSeeder::class,            
            EmergencyNumbersTableSeeder::class,
            RoomsTableSeeder::class,
            RoomTravellerTableSeeder::class,
            DestinationTableSeeder::class,
            PlanningTableSeeder::class,
        ]);
    }
}
