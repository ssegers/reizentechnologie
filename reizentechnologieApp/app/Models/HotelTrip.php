<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HotelTrip extends Model
{

    public function trips()
    {
        return $this->hasMany('App\Models\Trip', 'trip_id', 'trip_id');
    }

    public function hotels()
    {
        return $this->hasMany('App\Models\Hotel', 'hotel_id', 'hotel_id');
    }

    public function rooms(){
        return $this->hasMany('App\Models\Room', 'id', 'hotel_trip_id');
    }
}
