<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $primary_key = "room_id";

    public function hotel() {
        //return $this->hasOne('App\Models\Hotel', 'id', 'room_id');
        return $this->belongsTo(Hotel::class, null, 'id', 'room_id');
    }
}
