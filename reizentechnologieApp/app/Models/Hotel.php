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
}
