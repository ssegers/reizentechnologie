<?php

namespace App\Repositories\Eloquent;
use App\Repositories\Contracts\TripRepository;

use App\Models\Traveller;
use App\Models\Trip;
use App\Models\Destination;
use App\Models\Transport;

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
        $aTrips = Trip::IsActive()->select('trip_id','name','year')->orderBy('trip_id')->get();
        return $aTrips;
    }

    public function getActiveByOrganiser($iUserId) {
        $aActiveTripsByOrganiser = Traveller::where('user_id', $iUserId)->first()
                ->trips()->where('is_active',true)->wherePivot('is_organizer', true)
                ->select('trips.trip_id','trips.name','trips.year')
                ->orderBy('trips.trip_id')->get();
        return $aActiveTripsByOrganiser;
    }
    
    public function getActiveTripsForTraveller($iUserId)
    {
        $aActiveTripsForTraveller = Traveller::where('user_id', $iUserId)->first()
                ->trips()->where('is_active',true)
                ->select('trips.trip_id','trips.name','trips.year')
                ->get();
               
        return $aActiveTripsForTraveller;
    }
    public function getAllActiveWithContact() {
        return Trip::IsActive()->HasContact()->pluck('name','trip_id');
        
    }
    public function getNumberOfAttendants($iTripId) {
        $oTrip = Trip::where('trip_id',$iTripId)->withcount('travellers')->first();
        return $oTrip->travellers_count;
    }
    
    /**
     * get organizers for the given trip
     * 
     * @autor Stefan Segers
     * @param integer $iTripId 
     * @return $aOrganizers 
     */        
    public function getOrganizersByTrip($iTripId)
    {
        $aOrganizers = Trip::where('trip_id', $iTripId)->first()
                ->travellers()->wherePivot('is_organizer', true)
                ->select('travellers.traveller_id','travellers.first_name','travellers.last_name')
                ->get();
        $aSubsetOfOrganizers = $aOrganizers->map(function ($oOrganiser) {
                return collect($oOrganiser->toArray())
                ->only(['traveller_id', 'first_name', 'last_name'])
                ->all();
            });
        return $aSubsetOfOrganizers;
    }
    /**
     * get all possible drivers for the given trip
     * @author Stefan Segers
     * @param integer $iTripid the trip_id
     * @return collection possibleDrivers 
     */
    
    public function getPossibleDriversForTheTrip($tripId){
        
        $driversForTrip = Trip::where('trip_id', $tripId)->first()
                ->travellers()->wherePivot('is_guide', true)
                ->select('travellers.traveller_id','travellers.first_name','travellers.last_name')
                ->get()->toArray();
        //set key to traveller_id
        foreach ($driversForTrip as $index => $driverForTrip){
            $driversForTrip[$driverForTrip["traveller_id"]] = $driverForTrip;
            unset($driversForTrip[$index]);
        }
        $driversForTrip = collect($driversForTrip);
        
        $driversInUse = Transport::where('trip_id', $tripId)->get()->toArray();
        //set key to driver_id (=traveller_id)
        foreach ($driversInUse as $index => $driverInUse){
            $driversInUse[$driverInUse["driver_id"]] = $driverInUse;
            unset($driversInUse[$index]);
        }
        $driversInUse = collect($driversInUse);
        
        //div on keys
        $possibleDrivers = $driversForTrip->diffKeys($driversInUse);

        return $possibleDrivers;
    }
    
    /**
     * set organizer for a trip
     * 
     * @autor Stefan Segers
     * @param integer $iTripId
     * @param integer $iTravellerId   
     * @return boolean
     */
    public function setTravellerAsTripOrganizer($iTripId,$iTravellerId)
    {
        $oTrip = Trip::where('trip_id', $iTripId)->first()
                ->travellers()->wherePivot('traveller_id',$iTravellerId)->first();
        if ($oTrip != null){
            $oTrip->pivot->is_organizer = true;
            $oTrip->pivot->save();
        }else{
            $oTrip = Trip::where('trip_id', $iTripId)->first();           
            $oTrip->travellers()->attach($iTravellerId,['is_guide' => true, 'is_organizer' => true]);
        }
        return true;
        
    }

    /**
     * remove organizer from trip
     * 
     * @autor Stefan Segers
     * @param integer $iTripId
     * @param integer $iTravellerId  
     * @return boolean 
     */     
    public function removeOrganizerFromTrip($iTripId,$iTravellerId)
    {
        $oTrip = Trip::where('trip_id', $iTripId)->first()
            ->travellers()->wherePivot('traveller_id',$iTravellerId)->first();
        if ($oTrip != null){
            $oTrip->pivot->is_organizer = false;
            $oTrip->pivot->save();     
        }
    }
    
    public function getDestinations() {
        $aDestinations = Destination::get()->pluck('destination_name','destination_name');
        return $aDestinations;
    }
}
