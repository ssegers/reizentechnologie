<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Traveller extends Model
{
    protected $guarded = ['traveller_id'];
    protected $primaryKey = 'traveller_id';

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'user_id');
    }

    public function zip()
    {
        return $this->belongsTo('App\Models\Zip', 'zip_id', 'zip_id');
    }

    public function major()
    {
        return $this->belongsTo('App\Models\Major', 'major_id', 'major_id');
    }
    
    public function trips()
    {
        return $this->belongsToMany(Trip::class,null,'traveller_id','trip_id')
            ->withTimestamps()
            ->withPivot(['is_guide','is_organizer']);
    }

    public function payments(){
        return $this->hasMany('App\Models\Payment','traveller_id','traveller_id');
    }

    public function emergencyNumbers(){
        return $this->hasMany(EmergencyNumbers::class, null, traveller_id, emergencynumber_id);
    }
}
