<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    protected $primaryKey = 'hotel_id';

    public function trips()
    {
        return $this->belongsToMany(Trip::class,null,'hotel_id','trip_id')->withPivot(['start_date', 'end_date']);
    }

    public function rooms()
    {
        //return $this->belongsToMany(Room::class, null, 'hotel_id', 'id');
        return $this->hasMany('App\Models\Room', 'id', 'room_id');
    }
}
