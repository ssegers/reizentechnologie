<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Study extends Model
{
    protected $primaryKey = 'study_id';
    
    public function major()
    {
        return $this->hasMany('App\Models\Major', 'study_id', 'study_id');
    }
}
