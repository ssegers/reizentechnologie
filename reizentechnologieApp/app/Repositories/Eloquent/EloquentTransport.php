<?php

namespace App\Repositories\Eloquent;
use App\Repositories\Contracts\TransportRepository;
use Illuminate\Support\Facades\DB;

use App\Models\Trip;
use App\Models\Transport;

/**
 * accessing trip data
 *
 * @author u0067341
 */
class EloquentTransport implements TransportRepository
{
   /**
     * add transportation
     * 
     * @return boolean
     */ 
    public function addTransport($tripId,$driverId=null,$size){
        $transport = new Transport();
        $transport->trip_id = $tripId;
        $transport->size = $size;
        
        $transport->driver_id = $driverId;
        $transport->save();
        return true;
    }    
    
   /**
     * delete transportation
     * 
     * @return boolean
     */   
    public function deleteTransport($transportId){
        Transport::destroy($transportId);
        return true;
    }
    /**
     * get all vans for a specific trip
     * 
     * @return collection
     */    
    public function getVansPerTrip($iTripId) 
    {
        $vans = Trip::where('trip_id',$iTripId)->first()
                ->vans()->with('driver')->get();
        return $vans;   
    }    

    public function getVanOccupation($vanId)
    {
        $van = Transport::where('transport_id',$vanId)->withcount('travellers')->first();
        return $van->travellers_count;
    }
    
    public function getTravellersPerVan($vanId)
    {
        $travellersPerVan = TransPort::find($vanId)->travellers()->select('travellers.traveller_id','travellers.first_name','travellers.last_name')->get();
        return $travellersPerVan;
    }
    
    public function hasTransport($travellerId,$tripId)
    {
        $vans = Transport::where('trip_id',$tripId)->get();
        foreach($vans as $van){
            $traveller = $van->travellers()->wherePivot('traveller_id',$travellerId)->first();
            if ($traveller != null){
                return true;
            }
        }
        return false;
    }

    public function addTravellerToVan($travellerId,$transportId)
    {
        $van = Transport::find($transportId)->travellers()->attach($travellerId);
        return true;
    }

    public function removeFromVan($transportId,$travellerId)
     {

        $test = Transport::find($transportId)->travellers()->detach($travellerId);
        return true;
     }    
}