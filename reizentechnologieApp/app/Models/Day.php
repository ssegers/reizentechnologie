<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    protected $primaryKey = 'day_id';

    public function plannings() {
        return $this->hasMany('App\Models\Planning', 'day_id', 'day_id');
    }

    public function trip() {
        return $this->belongsTo(Trip::class, null, 'trip_id', 'trip_id');
    }
}
