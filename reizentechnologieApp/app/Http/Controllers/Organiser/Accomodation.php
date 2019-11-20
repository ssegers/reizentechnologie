<?php

namespace App\Http\Controllers\Organiser;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Repositories\Contracts\TripRepository;
use App\Repositories\Contracts\AccomodationRepository;

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
     * accomodationController Constructor
     * 
     * @param tripRepository $trip
     * @param accomodationRepository $accomodation
     */
    public function __construct(TripRepository $trip, AccomodationRepository $accomodation) 
    {
       $this->trips = $trip;
       $this->accomodations = $accomodation;
    }
    
    public function overview(Request $request, $iTripId = null)
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
        /* Check if user can access the data of the requested trip */
        if (!$aTripsByOrganiser->contains('trip_id',$iTripId)){
            return abort(403);
        }
      
        /* Get the current trip */
        $oCurrentTrip = $this->trips->get($iTripId);
        $accomodationsPerTrip = $this->accomodations->getAccomodationsPerTrip($iTripId);
        
        /* get accomodations list for the current trip */
        $aAccomodations = $this->accomodations->getAccomodationsByDestination($oCurrentTrip->name);
        //dd($aAccomodations->pluck('hotel_name','hotel_id'));
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
     * @author Michiel Guilliams
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addAccomodationToTrip(Request $request){
     
        $aData['trip_id'] = $request->post('trip_id');
        $aData['hotel_id'] = $request->post('hotel_id');
        $aData['start_date'] = $request->post('checkIn');
        $aData['end_date'] = $request->post('checkOut');
        
        $this->accomodations->addAccomodationsToTrip($aData);

        return redirect()->back();
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
     
        $this->accomodations->storeAccomodation($request);

        return redirect()->back();
    }
    
    /**
     * delete accomodation
     *
     * @author
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteAccomodation(Request $request){

        $this->accomodations->deleteAccomodation($request->input('hotel_trip_id'));
        $aRoomsId=RoomsPerHotelPerTrip::where('hotels_per_trip_id',$hotels_per_trip_id)->select('rooms_hotel_trip_id')->get();
        TravellersPerRoom::whereIn('rooms_hotel_trip_id',$aRoomsId)->delete();
        RoomsPerHotelPerTrip::where('hotels_per_trip_id',$hotels_per_trip_id)->delete();
        HotelsPerTrip::where('hotels_per_trip_id',$hotels_per_trip_id)->delete();
        return redirect()->back()->with('message', 'Het verblijf is verwijderd');
    }    
}
