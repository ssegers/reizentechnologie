<?php

namespace App\Repositories\Eloquent;
use App\Repositories\Contracts\AccomodationRepository;

use App\Models\Trip;
use App\Models\Hotel;

/**
 * accessing trip data
 *
 * @author u0067341
 */
class EloquentAccomodation implements AccomodationRepository
{
    public function getAccomodationsPerTrip($iTripId) {
        $accomodations = Trip::where('trip_id',$iTripId)->first()->accomodations()->orderBy('start_date','asc')->get();
        //dd($accomodations);
        return $accomodations;   
    }    
  

    /**
     * get all accomodations for a specific destination
     * 
     * @return collection
     */
    public function getAccomodationsByDestination($sDestinationName)
    {
        $aAccomodations = Hotel::where('trip_destination',$sDestinationName)->get()->pluck('hotel_name','hotel_id');
        return $aAccomodations;
    }
    
    /**
     * add accomodations to trip
     * 
     * @return 
     */
    public function addAccomodationsToTrip($aData)
    {
        $trip = Trip::find($aData['trip_id']);
        $trip->accomodations()->attach($aData['hotel_id'],['start_date' => $aData['start_date'], 'end_date' => $aData['end_date']]);
        return true;
    }
}