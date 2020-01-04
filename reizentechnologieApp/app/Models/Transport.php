<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transport extends Model
{
    protected $primaryKey = 'transport_id';

    public function trip()
    {
        return $this->belongsTo(Trip::class,'trip_id','trip_id');
    }
    public function travellers()
    {
        return $this->belongsToMany(Traveller::class,null,'transport_id','traveller_id')
            ->withTimestamps();
    }
    public function driver()
    {
        return $this->belongsTo(Traveller::class,'driver_id','traveller_id')->select(array('traveller_id', 'first_name','last_name'));
    }
}
