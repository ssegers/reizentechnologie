<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $primaryKey = 'room_id';
    
    public function travellers()
    {
        return $this->belongsToMany(Traveller::class,null,'room_id','traveller_id')
            ->withTimestamps();
    }
}
