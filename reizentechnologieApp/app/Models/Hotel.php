<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    protected $primaryKey = 'hotel_id';

    public function trips()
    {
        return $this->hasMany('App\Models\Trip', 'trip_id', 'trip_id');
    }
}
