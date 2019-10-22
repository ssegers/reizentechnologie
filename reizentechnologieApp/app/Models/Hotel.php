<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    protected $primaryKey = 'hotel_id';
    
    public function trips()
    {
        return $this->belongsToMany(Trips::class,null,'trip_id','trip_id')
            ->withTimestamps()
            ->withPivot(['start_date','end_date']);
    }
}

