<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    protected $primaryKey = 'hotel_id';

    public function trips()
    {
        return $this->belongsToMany(Trip::class,null,'hotel_id','trip_id');
    }

    public function rooms()
    {
        return $this->belongsToMany(Room::class, null, 'hotel_id', 'room_id');
    }
}
