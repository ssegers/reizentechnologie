<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmergencyNumbers extends Model
{
    public function travellers(){
        return $this->belongsTo(Travellers::class, null, 'emergencynumber_id', 'traveller_id');
    }
}
