<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    protected $primaryKey = 'trip_id';
    
    public function travellers()
    {
        return $this->belongsToMany(Traveller::class,null,'trip_id','traveller_id')
            ->withTimestamps()
            ->withPivot(['is_guide','is_organizer']);
    }
    public function accomodations()
    {
        return $this->belongsToMany(Hotel::class,null,'trip_id','hotel_id')
            ->withTimestamps()
            ->withPivot(['id','start_date','end_date']);
    }
    
    public function vans()
    {
        return $this->hasMany('App\Models\Transport','trip_id','trip_id');
    }
    
    public function payments()
    {
        return $this->hasMany('App\Models\Payment','trip_id','trip_id');
    }
    
    public function scopeIsActive($query)
    {
        return $query->whereIs_active(1)->orderBy('name');
    }
    
    public function scopeHasContact($query)
    {
        return $query->whereNotNull('Contact_mail');
    }
}
