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
            'picture1_link' => 'http://www.americanriverresort.com/media/rokgallery/3/3054c425-30fc-4e20-d4e9-cb38cab75e85/6aeaa353-fb39-4d50-f9bc-b8b5ee3af3cd.jpg',
            'picture2_link' => 'http://www.americanriverresort.com/media/rokgallery/5/530a392f-7d38-4c8b-f19b-7361c4dc74d2/55912a1b-a215-4f68-8858-4dd1401e641a.jpg',
        ));

        DB::table('hotels')->insert(array(
            'hotel_name' => 'Comfort Inn Lone Pine',
            'trip_destination' => 'Amerika',
            'type_of_accomodation' => 'Hotel',
            'address' => '1920 S Main Street Lone Pine, CA 93545',
            'phone' => '+1 760 876 8700',
            'email' => "example@ucll.be",
            'website_link' => 'http://www.comfortinnlonepine.com/',
            'picture1_link' => 'https://www.alcatrazcruises.com/wp-content/uploads/2018/02/revolving-hero3-1600x650.jpg',
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
            'picture1_link' => 'https://img.cinemablend.com/filter:scale/quill/9/f/a/d/b/e/9fadbe0c981cabb39921bc2c2d069694a1aa115c.jpg?mw=600',
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
