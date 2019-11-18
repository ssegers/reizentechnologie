<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activities extends Model
{
    protected $primaryKey = 'activities_id';

    public function day_planning(){
        return $this->belongsTo(DayPlanning::class, null, 'activities_id', 'day_planning_id');
    }
}
