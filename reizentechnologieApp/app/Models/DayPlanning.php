<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DayPlanning extends Model
{
    protected $primaryKey = 'day_planning_id';

    public function activities(){
        return $this->hasMany('App\Models\Activities', 'activities_id', 'day_planning_id');
    }

    public function trip(){
        return $this->belongsTo(Trip::class, null, 'day_planning_id', 'day_planning_id');
    }
}
