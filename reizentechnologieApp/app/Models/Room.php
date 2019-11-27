<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $primaryKey = 'room_id';

    public function hoteltrips() {
        return $this->belongsTo(HotelTrip::class, null, 'hotel_trip_id', 'id');
    }

    public function travellers() {
        return $this->belongsToMany(Traveller::class, null, "room_id", "traveller_id");
        //return $this->hasMany('App\Models\Traveller', 'room_id', "traveller_id");
    }
}
