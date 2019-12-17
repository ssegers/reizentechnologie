<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Planning extends Model
{
    protected $primaryKey = 'planning_id';

    protected $fillable = ["activity_id"];

    public function activity(){
        return $this->hasOne('App\Models\Activities', 'activity_id', 'activity_id');
    }

    public function day(){
        return $this->belongsTo(Day::class, 'day_id', 'day_id');
    }
}
