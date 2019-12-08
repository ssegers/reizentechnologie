<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Trip;
use App\Models\Traveller;

class Transport extends Model
{
    protected $primaryKey = 'transport_id';

    public function trip(){
        return $this->belongsTo(Trip::class, null, 'transport_id', 'trip_id');
    }

    public function driver() {
        return $this->hasOne('App\Models\Traveller', 'traveller_id', 'driver_id');
    }

    public function travellers() {
        return $this->belongsToMany(Traveller::class, 'transport_traveller', 'transport_id', 'traveller_id');
    }
}