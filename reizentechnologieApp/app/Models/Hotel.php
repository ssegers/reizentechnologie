<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    protected $primaryKey = 'hotel_id';

    public function hotelTrips()
    {
        return $this->hasMany('App\Models\HotelTrip', 'hotel_id', 'hotel_id');
    }

    public function rooms()
    {
        $hotelTripId = $this->hotelTrips()->first()->id;
        return Room::where('hotel_trip_id', '=', $hotelTripId)->get();
    }
}
