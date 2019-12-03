<?php

namespace App\Http\Controllers\Organiser;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

use App\Repositories\Contracts\TripRepository;
use App\Repositories\Contracts\AccomodationRepository;
use App\Repositories\Contracts\TravellerRepository;

use Illuminate\Support\Facades\Auth;



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
     *
     * @var travellerRepository
     */
    private $travellers;

    /**
     * accomodationController Constructor
     * 
     * @param tripRepository $trip
     * @param accomodationRepository $accomodation
     */
    public function __construct(TripRepository $trip, 
            AccomodationRepository $accomodation,
            TravellerRepository $traveller) 
    {
       $this->trips = $trip;
       $this->accomodations = $accomodation;
       $this->travellers = $traveller;
    }
    
    /**
     * 
     * @return boolean
     */
    private function hasRights() 
    {
        //checks if the current user is admin or organiser for the trip
        $oUser = Auth::user();
        $bIsOrganizer=false;
        
        if($oUser->role!='admin'){          
            $bIsOrganizer = $this->travellers->isOrganizerForTheTrip(session('tripId'));
            
        }
        if (($oUser->role == 'guide'&& $bIsOrganizer)||($oUser->role=='admin')){
         // dd($this->travellers->isOrganizerForTheTrip(session('tripId')),$bIsOrganizer,$oUser->role);
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
        $accomodationsPerTrip = $this->accomodations->getAccomodationsPerTrip($iTripId);

        /* get accomodations list for the current trip */
        $aAccomodations = $this->accomodations->getAccomodationsByDestination($oCurrentTrip->name);
        return view('organizer.lists.accomodations',
            [
                'accomodationsPerTrip' => $accomodationsPerTrip,
                'aAccomodations' => $aAccomodations,
                'oCurrentTrip' => $oCurrentTrip,
                'aTripsAndNumberOfAttendants' => $aTripsAndNumberOfAttendants,
                'aTripsByOrganiser' => $aTripsByOrganiser,
            ]);
        
    }
    
    /**
     * add accomodation to trip
     *
     * @author 
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addAccomodationToTrip(Request $request){
        
        if ($this->hasRights()){ 
            $aData['trip_id'] = $request->post('trip_id');
            $aData['hotel_id'] = $request->post('hotel_id');
            $aData['start_date'] = $request->post('checkIn');
            $aData['end_date'] = $request->post('checkOut');        
            $this->accomodations->addAccomodationsToTrip($aData);
            return redirect()->back();
        }else{
            return redirect()->back()->with('errormessage', 'je hebt onvoldoende rechten voor deze bewerking');
        } 
    }
    
    /**
     * create accomodation
     *
     * @author 
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createAccomodation(Request $request){
        if ($this->hasRights()){   
            $this->accomodations->storeAccomodation($request);
            return redirect()->back()->with('successmessage','verblijfsaccomodatie succesvol aangemaakt');
        }else{
            return redirect()->back()->with('errormessage', 'je hebt onvoldoende rechten voor deze bewerking');
        }
    }
    
    /**
     * update accomodation
     *
     * @author
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateAccomodation(Request $request){
       
        if ($this->hasRights()){
            
            $this->accomodations->updateAccomodation($request);
             
            return redirect()->back();
            dd($this->hasRights());
        }else{
            return redirect()->back()->with('errormessage', 'je hebt onvoldoende rechten voor deze bewerking');
        }
    }

    /**
     * delete accomodation
     *
     * @author
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteAccomodation($hotelTripId){
        if ($this->hasRights()){   
            $this->accomodations->deleteAccomodationFromTrip($hotelTripId);
            return redirect()->back()->with('message', 'Het verblijf is verwijderd uit deze reis');
        }else{
            return redirect()->back()->with('errormessage', 'je hebt onvoldoende rechten voor deze bewerking');
        }
    } 
}
