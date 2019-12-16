<?php

namespace App\Http\Controllers\Organiser;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Auth;

use App\Repositories\Contracts\TripRepository;
use App\Repositories\Contracts\TravellerRepository;
use App\Repositories\Contracts\DayPlanningRepository;

class DayPlanningController extends Controller
{

    /**
     *
     * @var tripRepository
     */
    private $trips;

    /**
     *
     * @var travellerRepository
     */
    private $travellers;

    /**
     * 
     * @var dayplanningRepository
     */
    private $dayplanning;
    


    /**
     * dayplanningController Constructor
     * 
     * @param tripRepository $trip
     * @param dayplanningRepository $dayplanning
     */
    public function __construct(TripRepository $trip, 
            DayPlanningRepository $dayplanning,
            TravellerRepository $traveller) 
    {
       $this->trips = $trip;
       $this->dayplannings = $dayplanning;
       $this->travellers = $traveller;
    }
    
    public function CheckDbConnection(){
        try {
            DB::connection()->getPdo();
        } catch (\Exception $e) {
            return  true ;  
        }
    }

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
    
    public function index($iTripId = null) {
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
        $dayplanningsPerTrip = $this->dayplannings->getDayPlanningsPerTrip($iTripId);

        return view('organizer.dayplanning',
            [
                'dayplanningsPerTrip' => $dayplanningsPerTrip,
                'oCurrentTrip' => $oCurrentTrip,
                'aTripsAndNumberOfAttendants' => $aTripsAndNumberOfAttendants,
                'aTripsByOrganiser' => $aTripsByOrganiser,
            ]);
    }

    public function addDayPlanningToTrip(Request $request){
        
        if ($this->hasRights()){ 
            $aData['trip_id'] = $request->post('trip_id');
            $aData['day_id'] = $request->post('day_id');
            $aData['location'] = $request->post('location');
            $aData['description'] = $request->post('description');  
            $aData['highlight'] = $request->post('highlight');
            $this->dayplannings->addDayPlanningToTrip($aData);
            return redirect()->back();
        }else{
            return redirect()->back()->with('errormessage', 'je hebt onvoldoende rechten voor deze bewerking');
        } 
    }

    public function createDayPlanning(Request $request){
        if ($this->hasRights()){   
            $this->dayplannings->storeDayPlanning($request);
            return redirect()->back()->with('successmessage','dag succesvol aangemaakt');
        }else{
            return redirect()->back()->with('errormessage', 'je hebt onvoldoende rechten voor deze bewerking');
        }
    }

    public function updateDayPlanning(Request $request){
       
        if ($this->hasRights()){
            
            $this->dayplannings->updateDayPlanning($request);
             
            return redirect()->back();
            dd($this->hasRights());
        }else{
            return redirect()->back()->with('errormessage', 'je hebt onvoldoende rechten voor deze bewerking');
        }
    }

    public function deleteDayplanning($dayId){
        if ($this->hasRights()){   
            $this->accomodations->deleteDayPlanningFromTrip($dayId);
            return redirect()->back()->with('message', 'De dag is verwijderd uit deze reis');
        }else{
            return redirect()->back()->with('errormessage', 'je hebt onvoldoende rechten voor deze bewerking');
        }
    } 
}