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
    
    public function trips()
    {
        return $this->belongsToMany(Trips::class,null,'trip_id','trip_id')
            ->withTimestamps()
            ->withPivot(['id','start_date','end_date']);
    }
}

