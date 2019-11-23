<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmergencyNumbers extends Model
{
    public function travellers(){
        return $this->belongsToMany(Trips::class, null, 'emergencynumber_id', 'trip_id');
    }
}
