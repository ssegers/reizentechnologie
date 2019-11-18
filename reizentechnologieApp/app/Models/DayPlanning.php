<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DayPlanning extends Model
{
    protected $primaryKey = 'day_planning_id';

    public function activities(){
        return $this->hasMany(Activities::class, null, 'day_planning_id', 'activities_id');
    }

    public function trips(){
        return $this->belongsTo(Trip::class, null, 'day_planning_id', 'trip_id');
    }
}
