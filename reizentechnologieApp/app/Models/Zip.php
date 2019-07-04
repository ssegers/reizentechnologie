<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Zip extends Model
{
    protected $primaryKey = 'zip_id';
   
    public static function exists($zip,$city){
        if (Zip::where('zip_code', $zip)->where('city', $city)->count() > 0){
            return true;
        }else{
            return false;
        }
    }

}
