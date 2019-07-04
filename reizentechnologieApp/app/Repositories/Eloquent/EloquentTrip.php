<?php

namespace App\Repositories\Eloquent;
use App\Repositories\Contracts\TripRepository;

use App\Models\Trip;
use App\Models\TravellerTrip;

use App\Models\User;

/**
 * accessing trip data
 *
 * @author u0067341
 */
class EloquentTrip implements TripRepository
{
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
        $aActiveTripsByOrganiser = User::where('users.user_id', $iUserId)->where('is_active', true)->where('is_organizer', true)
                ->join('travellers', 'travellers.user_id', '=', 'users.user_id')
                ->join('traveller_trip', 'traveller_trip.traveller_id', '=', 'travellers.traveller_id')
                ->join('trips', 'trips.trip_id', '=', 'traveller_trip.trip_id')
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

    public function getAttendantsPerTrip($iTripId) {
        $travellers = TravellerTrip::with('Traveller','Trip')->where('trip_id',$iTripId)->get(); 
        
//        $travellers = Traveller::with('User' , 'Zip', 'Major', 'Major.Study','TravellerTrip','TravellerTrip.Trip')->where('user_id',$id)->first();
//        $aProfileData = $travellers->attributesToArray();
//        $aProfileData = array_merge($aProfileData,$travellers->user->attributesToArray());
//        $aProfileData = array_merge($aProfileData,$travellers->zip->attributesToArray());
//        $aProfileData = array_merge($aProfileData,$travellers->major->attributesToArray());
//        $aProfileData = array_merge($aProfileData,$travellers->major->study->attributesToArray());
//        $aProfileData = array_merge($aProfileData,$travellers->travellersPerTrip[0]->trip->attributesToArray());
        return $travellers;
    }
    
}
