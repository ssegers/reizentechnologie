<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activities extends Model
{
    protected $primaryKey = 'activity_id';

    public function planning(){
        return $this->belongsTo(Planning::class, 'activity_id', 'activity_id');
    }
}
