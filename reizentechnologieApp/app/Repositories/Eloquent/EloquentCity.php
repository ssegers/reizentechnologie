<?php

namespace App\Repositories\Eloquent;
use App\Repositories\Contracts\CityRepository;

use App\Models\Zip;

/**
 * accessing city data
 *
 * @author u0067341
 */
class EloquentCity implements CityRepository
{
    /**
     * Insert new record into zips table
     * @param type $aData
     */
    
    public function store($aData) {
        
        $newCity = new Zip;
        $newCity->zip_code = $aData['zip_code'];
        $newCity->city = $aData['city'];
        $newCity->save();
        return $newCity;
    }
    
    public function get(){
        return Zip::orderBy('city')->get();
    }
}