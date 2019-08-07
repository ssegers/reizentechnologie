<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\Contracts\StudieRepository;
use App\Repositories\Contracts\TripRepository;

class DataController extends Controller
{
    /**
     *
     * @var studieRepository
     */
    private $studies;
    
    /**
     *
     * @var tripRepository
     */
    private $trips;
    
    
    function __construct(StudieRepository $studie, TripRepository $trip) {
        $this->middleware('auth');
        $this->middleware('checkloggedin');

        $this->studies = $studie;
        $this->trips = $trip;
    }
    
    /**
     * 
     * @param type $studyId
     * @return type
     */
    public function getMajorsByStudy($studyId)
    {    
        $aMajors = $this->studies->getMajorsByStudy($studyId);
        return json_encode($aMajors);
    }
    
    /**
     * get organizers by trip and result in Json format
     * 
     * @author Stefan Segers
     * @param type $tripId
     * @return type
     */
    public function getOrganizersByTrip($iTripId)
    {   
        $aOrganizers = $this->trips->getOrganizersByTrip($iTripId);
        return response()->json(['aOrganizers' => $aOrganizers]);
    }

    /**
     * 
     * @return type
     */
    public function addOrganizersToTrip(Request $request){

        // this will automatically return a 422 error response when request is invalid
        $this->validate($request, [
            'traveller_ids' => 'required',
            'trip_id' => 'required',
        ]);

        // below is executed when request is valid
        $aTravellerId = $request->post('traveller_ids');
        $iTripId = $request->post('trip_id');

        foreach($aTravellerId as $iTravellerId){
            $this->trips->setTravellerAsTripOrganizer($iTripId, $iTravellerId);
        }

        //$request->session()->flash('message', 'De geselecteerde begeleiders werden aan de geselecteerde reis gekoppeld.');
        return response()->json(['success' => true]);  
    }
  
    public function removeOrganizerFromTrip(Request $request)
    {
        $iTravellerId = $request->post('traveller_id');
        $iTripId = $request->post('trip_id');
        //is_organizer veld op false zetten in TravellersPerTrip
        $this->trips->removeOrganizerFromTrip($iTripId, $iTravellerId);
       // $request->session()->flash('message', 'Het verwijderen van de begeleider is gelukt.');
        return response()->json(['success' => true]);  
    }
}