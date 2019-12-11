<?php

use Illuminate\Database\Seeder;

class PlanningTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // activiteiten dag 1
        DB::table('plannings')->insert(array(
            'activity_id' => 1,
            'day_id' => 1,
            'start_hour' => '07:00',
            'end_hour' => '19:00'
        ));
        DB::table('plannings')->insert(array(
            'activity_id' => 2,
            'day_id' => 1,
            'start_hour' => '19:30',
            'end_hour' => '20:00'
        ));

        // activiteiten dag 2
        DB::table('plannings')->insert(array(
            'activity_id' => 3,
            'day_id' => 2,
            'start_hour' => '07:15',
            'end_hour' => '12:00'
        ));
        DB::table('plannings')->insert(array(
            'activity_id' => 4,
            'day_id' => 2,
            'start_hour' => '12:00',
            'end_hour' => '18:30'
        ));

        // activiteiten dag 3
        DB::table('plannings')->insert(array(
            'activity_id' => 5,
            'day_id' => 3,
            'start_hour' => '08:45',
            'end_hour' => '10:30'
        ));
        DB::table('plannings')->insert(array(
            'activity_id' => 6,
            'day_id' => 3,
            'start_hour' => '10:30',
            'end_hour' => '13:15'
        ));
        DB::table('plannings')->insert(array(
            'activity_id' => 7,
            'day_id' => 3,
            'start_hour' => '13:15',
            'end_hour' => '18:30'
        ));

        // activiteiten dag 4
        DB::table('plannings')->insert(array(
            'activity_id' => 8,
            'day_id' => 4,
            'start_hour' => '08:30',
            'end_hour' => '13:00'
        ));
        DB::table('plannings')->insert(array(
            'activity_id' => 9,
            'day_id' => 4,
            'start_hour' => '14:30',
            'end_hour' => '16:00'
        ));
        DB::table('plannings')->insert(array(
            'activity_id' => 10,
            'day_id' => 4,
            'start_hour' => '16:00',
            'end_hour' => '18:30'
        ));

        // activiteiten dag 5
        DB::table('plannings')->insert(array(
            'activity_id' => 11,
            'day_id' => 5,
            'start_hour' => '07:30',
            'end_hour' => '16:00'
        ));
        DB::table('plannings')->insert(array(
            'activity_id' => 12,
            'day_id' => 5,
            'start_hour' => '18:30',
            'end_hour' => '17:00'
        ));

        // activiteiten dag 6
        DB::table('plannings')->insert(array(
            'activity_id' => 13,
            'day_id' => 6,
            'start_hour' => '07:45',
            'end_hour' => '11:30'
        ));
        DB::table('plannings')->insert(array(
            'activity_id' => 14,
            'day_id' => 6,
            'start_hour' => '12:50',
            'end_hour' => '13:30'
        ));
        DB::table('plannings')->insert(array(
            'activity_id' => 15,
            'day_id' => 6,
            'start_hour' => '13:30',
            'end_hour' => '15:00'
        ));
        DB::table('plannings')->insert(array(
            'activity_id' => 16,
            'day_id' => 6,
            'start_hour' => '15:00',
            'end_hour' => '19:30'
        ));

        // activiteiten dag 7
        DB::table('plannings')->insert(array(
            'activity_id' => 17,
            'day_id' => 7,
            'start_hour' => '08:15',
            'end_hour' => '19:00'
        ));

        // activiteiten dag 8
        DB::table('plannings')->insert(array(
            'activity_id' => 18,
            'day_id' => 8,
            'start_hour' => '10:00',
            'end_hour' => '15:30'
        ));
        DB::table('plannings')->insert(array(
            'activity_id' => 19,
            'day_id' => 8,
            'start_hour' => '15:30',
            'end_hour' => '18:30'
        ));
        DB::table('plannings')->insert(array(
            'activity_id' => 20,
            'day_id' => 8,
            'start_hour' => '18:30',
            'end_hour' => '20:30'
        ));

        // activiteiten dag 9
        DB::table('plannings')->insert(array(
            'activity_id' => 21,
            'day_id' => 9,
            'start_hour' => '09:00',
            'end_hour' => '12:15'
        ));
        DB::table('plannings')->insert(array(
            'activity_id' => 22,
            'day_id' => 9,
            'start_hour' => '12:15',
            'end_hour' => '13:15'
        ));
        DB::table('plannings')->insert(array(
            'activity_id' => 23,
            'day_id' => 9,
            'start_hour' => '13:15',
            'end_hour' => '15:30'
        ));
        DB::table('plannings')->insert(array(
            'activity_id' => 24,
            'day_id' => 9,
            'start_hour' => '15:30',
            'end_hour' => '18:00'
        ));
        DB::table('plannings')->insert(array(
            'activity_id' => 25,
            'day_id' => 9,
            'start_hour' => '18:00',
            'end_hour' => '23:59'
        ));

        // activiteiten dag 10
        DB::table('plannings')->insert(array(
            'activity_id' => 26,
            'day_id' => 10,
            'start_hour' => '08:00',
            'end_hour' => '17:30'
        ));
        DB::table('plannings')->insert(array(
            'activity_id' => 27,
            'day_id' => 10,
            'start_hour' => '18:00',
            'end_hour' => '23:59'
        ));

        // activiteiten dag 11
        DB::table('plannings')->insert(array(
            'activity_id' => 28,
            'day_id' => 11,
            'start_hour' => '05:30',
            'end_hour' => '16:21'
        ));
        DB::table('plannings')->insert(array(
            'activity_id' => 29,
            'day_id' => 11,
            'start_hour' => '18:25',
            'end_hour' => '07:45'
        ));
    }
}
