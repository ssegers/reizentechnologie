<?php

namespace App\Http\Controllers\Organiser;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

use App\Repositories\Contracts\TripRepository;
use App\Repositories\Contracts\TransportRepository;
use App\Repositories\Contracts\TravellerRepository;

use Illuminate\Support\Facades\Auth;

class Transport extends Controller
{
    /**
     *
     * @var tripRepository
     */
    private $trips;

    /**
     *
     * @var transportRepository
     */
    private $transports;
    
    /**
     *
     * @var travellerRepository
     */
    private $travellers;            
    
    public function __construct(TripRepository $trip, TransportRepository $transport, 
            TravellerRepository $traveller)
    {
       $this->trips = $trip;
       $this->transports = $transport;
       $this->travellers = $traveller;
    }

    /**
     * This function checks if tif the current user is admin or organiser for 
     * the trip
     *
     * @author Stefan Segers
     *
     * @return boolean
     */
    private function hasRights() 
    {
        $oUser = Auth::user();
        $bIsOrganizer=false;
        
        if($oUser->role!='admin'){          
            $bIsOrganizer = $this->travellers->isOrganizerForTheTrip(session('tripId'));
        }
        if (($oUser->role == 'guide'&& $bIsOrganizer)||($oUser->role=='admin')){ 
            return true;
        }else{
            return false;
        }
    }
    
    /**
     * 
     * @param type $iTripId
     * @return type
     */
    public function overview($iTripId = null)
    {
        
        $oUser = Auth::user();
        /* Get all active trips and number of partisipants */
        $aActiveTrips = $this->trips->getAllActive();

        if($aActiveTrips->count() == 0){
            return Redirect::back()->withErrors(['er zijn geen active reizen om weer te geven']); 
        }
        foreach ($aActiveTrips as $oTrip) {
            $aTripsAndNumberOfAttendants[$oTrip->trip_id]['trip_id'] = $oTrip->trip_id;
            $aTripsAndNumberOfAttendants[$oTrip->trip_id]['name'] = $oTrip->name;
            $aTripsAndNumberOfAttendants[$oTrip->trip_id]['year'] = $oTrip->year;
            $aTripsAndNumberOfAttendants[$oTrip->trip_id]['numberOfAttends'] = $this->trips->getNumberOfAttendants($oTrip->trip_id);
        }
     
        /* Get all active trips that can be accessed by the user depending on his role */
        if ($oUser->role == 'admin') {
            $aTripsByOrganiser = $aActiveTrips;
        }elseif ($oUser->role == 'guide') {
            $aTripsByOrganiser = $this->trips->getActiveByOrganiser($oUser->user_id);
            if($aTripsByOrganiser->count() == 0){
                return Redirect::back()->withErrors(['er zijn geen active reizen om weer te geven']); 
            }
        }
        /* if tripId not set set tripId to the first active trip of the organiser */
        if ($iTripId == null) {
            $iTripId = $aTripsByOrganiser[0]->trip_id;
        }
        /* store active trip to session   */
        Session::put('tripId', $iTripId);
        
        /* Check if user can access the data of the requested trip */
        if (!$aTripsByOrganiser->contains('trip_id',$iTripId)){
            return abort(403);
        }
      
        /* Get the current trip */
        $oCurrentTrip = $this->trips->get($iTripId);
        
        /* get all vans for the current trip */
        $vansPerTrip = $this->transports->getVansPerTrip($iTripId);
        //dd($vansPerTrip,$vansPerTrip[0]->driver->first_name);
        $occupationPerVan = array();
        $travellersPerVan = array();
        foreach ($vansPerTrip as $van){
            $occupationPerVan[$van->transport_id] = $this->transports->getVanOccupation($van->transport_id);
            $travellersPerVan[$van->transport_id]= $this->transports->getTravellersPerVan($van->transport_id);
        }
        /* set currentTravellerId to 'admin' if admin or id if regular traveller*/
        if($oUser->role=='admin'){
            $currentTravellerId='admin';
        }
        else{
            $currentTravellerId = $oUser->traveller->traveller_id;
        } 
        
        return view('organizer.lists.vans',
            [
                'oCurrentTrip' => $oCurrentTrip,
                'aTripsAndNumberOfAttendants' => $aTripsAndNumberOfAttendants,
                'aTripsByOrganiser' => $aTripsByOrganiser,
                'vansPerTrip' => $vansPerTrip,
                'occupationPerVan' => $occupationPerVan,
                'travellersPerVan' => $travellersPerVan,
                'currentTravellerId' => $currentTravellerId,
            ]);        
    }
    public function deleteVan($transportId)
    {
        if ($this->hasRights()){
            $this->transports->deleteTransport($transportId);
            return redirect()->back();
        }else{
            return redirect()->back()->with('errormessage', 'je hebt onvoldoende rechten voor deze bewerking');
        }         
    }
    public function createVan(Request $request)
    {
        if ($this->hasRights()){
            
            $tripId = session('tripId');
            $driverId = $request->post('Driver');
            $size = $request->post('AutoSize');
            
            $this->transports->addTransport($tripId, $driverId, $size);
            
            return redirect()->back(); 
        }else{
            return redirect()->back()->with('errormessage', 'je hebt onvoldoende rechten voor deze bewerking');
        }                
    }
}
