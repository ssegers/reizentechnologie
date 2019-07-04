<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TravellerTrip extends Model
{
    protected $table = 'traveller_trip';
        //https://blog.maqe.com/solved-eloquent-doesnt-support-composite-primary-keys-62b740120f
    
    public function traveller()
    {
        return $this->belongsTo('App\Models\Traveller', 'traveller_id', 'traveller_id');
    }
    public function trip()
    {
        return $this->belongsTo('App\Models\Trip', 'trip_id', 'trip_id');
    }
}
