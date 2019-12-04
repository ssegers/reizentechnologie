<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HotelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('hotels')->insert(array(
            'hotel_name' => 'La Quinta Inn San Francisco North',
            'trip_destination' => 'Amerika',
            'type_of_accomodation' => 'Hotel',
            'address' => '20 Airport Blvd South San Francisco CA 94080',
            'phone' => '001 650 583 2223',
            'email' => "example@ucll.be",
            'website_link' => 'http://www.laquintasanfranciscoairportnorth.com/',
            'picture1_link' => 'https://www.wyndhamhotels.com/content/dam/property-images/en-us/lq/us/ca/s-san-francisco/52821/52821_exterior_view_2.jpg?crop=4197:2798;*,*&downsize=1800:*',
            'picture2_link' => 'https://www.wyndhamhotels.com/content/dam/property-images/en-us/lq/us/ca/s-san-francisco/52821/52821_exterior_view_3.jpg?crop=4347:2898;*,*&downsize=1800:*',
        ));

        DB::table('hotels')->insert(array(
            'hotel_name' => 'American Whitewater',
            'trip_destination' => 'Amerika',
            'type_of_accomodation' => 'Camping',
            'address' => '6019 New River Road Coloma, CA 95613',
            'phone' => '001 530 622 6700',
            'email' => "example@ucll.be",
            'website_link' => 'http://www.americanriverresort.com/',
            'picture1_link' => 'http://www.americanriverresort.com/index.php/whitewater-boating',
            'picture2_link' => 'http://www.americanriverresort.com/index.php/group-camping',
        ));

        DB::table('hotels')->insert(array(
            'hotel_name' => 'Comfort Inn Lone Pine',
            'trip_destination' => 'Amerika',
            'type_of_accomodation' => 'Hotel',
            'address' => '1920 S Main Street Lone Pine, CA 93545',
            'phone' => '+1 760 876 8700',
            'email' => "example@ucll.be",
            'website_link' => 'http://www.comfortinnlonepine.com/',
            'picture1_link' => '',
            'picture2_link' => '',
        ));

        DB::table('hotels')->insert(array(
            'hotel_name' => 'Hotel Super 8 Las Vegas Strip',
            'trip_destination' => 'Amerika',
            'type_of_accomodation' => 'Hotel',
            'address' => '4250 Koval Lane Las Vegas, NV 89109',
            'phone' => '+1 702 794 0888',
            'email' => "example@ucll.be",
            'website_link' => 'http://www.super8vegas.com/',
            'picture1_link' => '',
            'picture2_link' => '',
        ));

        DB::table('hotels')->insert(array(
            'hotel_name' => 'Hampton Inn & Suites LAX El Segundo',
            'trip_destination' => 'Amerika',
            'type_of_accomodation' => 'Hotel',
            'address' => '888 N Sepulveda Blvd El Segundo, CA 90245',
            'phone' => '+1 310 322 2900',
            'email' => "example@ucll.be",
            'website_link' => 'http://www.laxelsegundo.hamptonbyhilton.com/',
            'picture1_link' => 'https://www.hilton.com/im/en/LAXELHX/2692505/hampton-inn-and-suites-lax-el-segundo-exterior-1-.jpg?impolicy=crop&cw=5376&ch=3010&gravity=NorthWest&xposition=88&yposition=245&rw=768&rh=430',
            'picture2_link' => 'https://www.hilton.com/im/en/LAXELHX/2676970/hampton-inn-and-suites-lax-el-segundo-king-studio-suite-1-.jpg?impolicy=crop&cw=4608&ch=2580&gravity=NorthWest&xposition=312&yposition=210&rw=768&rh=430',
        ));
    }
}
