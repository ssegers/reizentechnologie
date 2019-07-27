<?php

namespace App\Repositories\Eloquent;
use App\Repositories\Contracts\TripRepository;

use App\Models\Traveller;
use App\Models\Trip;

/**
 * accessing trip data
 *
 * @author u0067341
 */
class EloquentTrip implements TripRepository
{
    /**
     * Insert new record into trip table
     * 
     * @author Stefan Segers
     * @param type $aTripData
     */
    public function store($aTripData) 
    {
        /* Create the trip */
        try{
            $oTrip = new Trip();
            $oTrip->name = $aTripData['name'];
            $oTrip->is_active = $aTripData['is_active'];
            $oTrip->year = $aTripData['year'];
            $oTrip->contact_mail = $aTripData['contact_mail'];
            $oTrip->price = $aTripData['price'];
            $oTrip->save();       
        }
        catch(\Exception $e)
        {
            throw $e;
        }
    }
    
    /**
     * update record into trip table
     * 
     * @author Stefan Segers
     * @param array $aTripData 
     * @param integer $iTripId
     */    
    public function update($aTripData,$iTripId)
    {
        /* Update the trip */
        try{
            $oTrip = Trip::find($iTripId);
            $oTrip->name = $aTripData['name'];
            $oTrip->is_active = $aTripData['is_active'];
            $oTrip->year = $aTripData['year'];
            $oTrip->contact_mail = $aTripData['contact_mail'];
            $oTrip->price = $aTripData['price'];
            $oTrip->save();
        }
        catch(\Exception $e)
        {
            throw $e;
        }
    }
    
    public function getAllTrips() {
        $trips = Trip::all();
        return $trips;
    }
    
    public function get($iTripId) {
        $oTrip = Trip::where('trip_id', $iTripId)->first();
        return $oTrip;
    }

    public function getAllActive() 
    {
        $aTrips = Trip::IsActive()->select('trip_id','name','year')->get();
        return $aTrips;
    }

    public function getActiveByOrganiser($iUserId) {
        $aActiveTripsByOrganiser = Traveller::where('user_id', $iUserId)->first()
                ->trips()->wherePivot('is_organizer', true)
                ->select('trips.trip_id','trips.name','trips.year')
                ->get();
               
        return $aActiveTripsByOrganiser;
    }
    public function getAllActiveWithContact() {
        return Trip::IsActive()->HasContact()->pluck('name','trip_id');
        
    }
    public function getNumberOfAttendants($iTripId) {
        $oTrip = Trip::where('trip_id',$iTripId)->withcount('travellers')->first();
        return $oTrip->travellers_count;
    }
    
}
