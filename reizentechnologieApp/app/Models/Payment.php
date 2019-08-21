<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $primaryKey = 'payment_id';
    
    public function traveller(){
        return $this->belongsTo('App\Models\Traveller','traveller_id','traveller_id');
    }
    
    public function trip(){
        return $this->belongsTo('App\Models\Trip','trip_id','trip_id');
    }
}
