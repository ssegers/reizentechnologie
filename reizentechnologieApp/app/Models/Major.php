<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
    protected $primaryKey = 'major_id';
    public function study()
    {
        return $this->belongsTo('App\Models\Study','study_id','study_id');
    }

    public function traveller()
    {
        return $this->hasMany('App\Models\Travellers', 'major_id', 'major_id');
    }
    
    public function scopeGetMajorsByStudy($query, $studyId)
    {
        return $query->where('study_id', $studyId);
    }
}
