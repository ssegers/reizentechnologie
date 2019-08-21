<?php

namespace App\Http\Controllers\Organiser;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;

use App\Repositories\Contracts\TripRepository;
use App\Repositories\Contracts\TravellerRepository;

class Payments extends Controller
{
    /**
     *
     * @var travellerRepository
     */
    private $travellers; 
    
    /**
     *
     * @var tripRepository
     */
    private $trips;

    public function __construct(TravellerRepository $traveller, 
            TripRepository $trip) 
    {
       $this->travellers = $traveller;
       $this->trips = $trip;

    }    
    /**
     * list of travellers and their payments for the selected trip 
     * @author Stefan Segers
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showPaymentsTable($iTripId = null){
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
        /* Check if user can access the data of the requested trip */
        if (!$aTripsByOrganiser->contains('trip_id',$iTripId)){
            return abort(403);
        }
      
        /* Get the current trip */
        $oCurrentTrip = $this->trips->get($iTripId);

//        $userdata = Traveller::getTravellersWithPayment($iTripId);
        $aPaymentData = $this->travellers->getPaymentData($iTripId);

        return view('user.lists.pay_overview',[
            'userdata' => $aPaymentData,
            'oCurrentTrip' => $oCurrentTrip,
            'aActiveTrips' => $aActiveTrips,
            'aTripsAndNumberOfAttendants' => $aTripsAndNumberOfAttendants,
            'aTripsByOrganiser' => $aTripsByOrganiser,]);
    }
}
