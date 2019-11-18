<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $primary_key = "room_id";

    public function hotel() {
        return $this->hasOne('App\Models\Hotel', 'hotel_id', 'room_id');
    }
}
