<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    /**
     * The attributes that sets the primary-key.
     *
     * @var string
     */
    protected $primaryKey = 'info_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'info_name', 'info_value'
    ];
}
