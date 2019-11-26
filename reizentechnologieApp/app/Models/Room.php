<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $primary_key = "room_id";

    public function hoteltrips() {
        return $this->belongsTo(HotelTrip::class, null, 'room_id', 'id');
    }

    public function travellers() {
        return $this->belongsToMany(Traveller::class, null, "traveller_id", "room_id");
    }
}
