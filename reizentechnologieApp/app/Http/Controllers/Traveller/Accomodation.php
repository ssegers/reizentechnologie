<?php

namespace App\Http\Controllers\Traveller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Auth;

use App\Repositories\Contracts\TripRepository;
use App\Repositories\Contracts\AccomodationRepository;

class Accomodation extends Controller
{
    /**
     *
     * @var tripRepository
     */
    private $trips;

    /**
     *
     * @var accomodationRepository
     */
    private $accomodations;
    
    /**
     * accomodationController Constructor
     * 
     * @param tripRepository $trip
     * @param accomodationRepository $accomodation
     */
    public function __construct(TripRepository $trip,
                        AccomodationRepository $accomodation) 
    {
        $this->trips = $trip;
        $this->accomodations = $accomodation;

    }
        
    public function overview()
    {
        //get the active user
        $user = Auth::user();
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
        /* get accomodations list for the current trip */
        $accomodationsPerTrip = $this->accomodations->getAccomodationsPerTrip($tripId);
        return view('user.accomodations.accomodations',
            [
                'accomodationsPerTrip' => $accomodationsPerTrip,
                'currentTrip' => $currentTrip,
            ]);
        
    }        

}
