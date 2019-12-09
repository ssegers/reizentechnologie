<?php

namespace App\Http\Controllers\Organiser;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use App\Repositories\Contracts\DayPlanningRepository;

class DayPlanningController extends Controller
{
    private $dayplanning;
    
    public function __construct(DayPlanningRepository $dayplanning) {
        $this->dayplanning = $dayplanning;
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
    
    public function index() {
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
        


    }
}