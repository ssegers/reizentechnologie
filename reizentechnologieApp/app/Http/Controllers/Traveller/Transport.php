<?php

namespace App\Http\Controllers\Traveller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use App\Repositories\Contracts\TransportRepository;
use App\Repositories\Contracts\TripRepository;

class Transport extends Controller
{
    /**
     *
     * @var transportRepository
     */
    private $transports;  

    /**
     *
     * @var tripRepository
     */
    private $trips;

    /**
     * transportController Constructor
     * 
     * @param transportRepository $transport
     *
     */
    public function __construct(TransportRepository $transport, TripRepository $trip) 
    {
       $this->transports = $transport;
       $this->trips = $trip;
    }

    /**
     * 
     * @return type
     */
    public function overview()
    {
        //get the active user
        $user = Auth::user();
        $currentTravellerId=$user->traveller->traveller_id;
        
        //get the active trip for this user
        $activeTripsForTraveller = $this->trips->getActiveTripsForTraveller($user->user_id);
        if($activeTripsForTraveller->count() == 0){
            return redirect()->back()->with('errormessage', 'er zijn geen actieve reizen om weer te geven'); 
        }elseif($activeTripsForTraveller->count() > 1){
             return redirect()->back()->with('errormessage', 'je bent ingeschreven voor meerdere actieve reizen, je kan maar met één actieve reis meegaan. Raadpleeg de organisator');
        }
        $tripId = $activeTripsForTraveller[0]['trip_id'];

        /* store active trip to session   */
        Session::put('tripId', $tripId);
        
        /* Get the current trip */
        $currentTrip = $this->trips->get($tripId);
        
        /* get all vans for the current trip */
        $vansPerTrip = $this->transports->getVansPerTrip($tripId);

        $occupationPerVan = array();
        $travellersPerVan = array();
        foreach ($vansPerTrip as $van){
            $occupationPerVan[$van->transport_id] = $this->transports->getVanOccupation($van->transport_id);
            $travellersPerVan[$van->transport_id]= $this->transports->getTravellersPerVan($van->transport_id);
        }
        
        return view('user.transport.vans',
            [
                'currentTrip' => $currentTrip,
                'vansPerTrip' => $vansPerTrip,
                'occupationPerVan' => $occupationPerVan,
                'travellersPerVan' => $travellersPerVan,
                'currentTravellerId' => $currentTravellerId,
            ]);        
    }
    
    /**
     * This function adds a traveller to a van
     *
     * @author Stefan Segers
     *
     * @param integer $transportId
     * @return \Illuminate\Http\RedirectResponse
     */
    function selectVan($transportId){
        $oUser = Auth::user();
        $travellerId = $oUser->traveller->traveller_id;
        $tripId = session('tripId');
        //check if already has room for this hotel_trip
        $hasTransport = $this->transports->hasTransport($travellerId,$tripId);
        
        if (!$hasTransport){
            $this->transports->addTravellerToVan($travellerId,$transportId);
            return redirect()->back();
        }else{
            return redirect()->back()->with('errormessage', 'U heeft al een vervoer gekozen voor deze reis');
        }
    }  
    
    
    /**
     * This function deletes a user out of a hotel room
     *
     * @author Stefan Segers
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    function leaveVan($transportId,$travellerId = null){
        
        if ($travellerId == null){
            $oUser = Auth::user();
            $travellerId=$oUser->traveller->traveller_id;
        }
        $this->transports->removeFromVan($transportId,$travellerId);
        return redirect()->back()->with('successmessage', 'U kunt nu een andere kamer kiezen');
    }
}
