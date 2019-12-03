<?php

namespace App\Http\Controllers\Organiser;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\RoomRepository;
use App\Repositories\Contracts\TravellerRepository;
use App\Repositories\Contracts\AccomodationRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class Rooms extends Controller
{
    /**
     *
     * @var roomRepository
     */
    private $rooms;    

    /**
     *
     * @var travellerRepository
     */
    private $travellers;        

    /**
     *
     * @var travellerRepository
     */
    private $accomodations;
    
    /**
     * roomsController Constructor
     * 
     * @param roomRepository $room
     *
     */
    public function __construct(RoomRepository $room, 
            TravellerRepository $traveller,
            AccomodationRepository $accomodation) 
    {
       $this->rooms = $room;
       $this->travellers = $traveller;
       $this->accomodations = $accomodation;
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
     * This function gets all rooms of the selected hotel for an admin or an organizer
     *
     * @author Michiel Guilliams
     *
     * @param $hotelTripId
     * @param $accomodationId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function overview($hotelTripId, $accomodationId)
    {
        /* store hotelTripId and hotelId in session*/
        session(['hotelTripId' => $hotelTripId, 'hotelId' => $accomodationId]);
        
        /* check if current user is 'admin'*/
        $oUser=Auth::user();
        if($oUser->role=='admin'){
            $userTravellerId='admin';
        }
        else{
            $userTravellerId=$oUser->traveller->traveller_id;
        }
        
        /* get all the rooms and their occupation */
        $aRooms = $this->rooms->getRoomsPerAccomodationPerTrip($hotelTripId);
        $aCurrentOccupation = array();
        $aTravellerPerRoom = array();
        foreach ($aRooms as $oRoom){
            $aCurrentOccupation[$oRoom->room_id] = $this->rooms->getRoomOccupation($oRoom->room_id);
            $aTravellerPerRoom[$oRoom->room_id]= $this->rooms->getTravellersPerRoom($oRoom->room_id);
        }
        
        /* get the name of the accomodation */
        $accomodationName = $this->accomodations->getAccomodationName($accomodationId);

        return view('organizer.lists.rooms',
            [
                'userTravellerId'=>$userTravellerId,
                'hotelTripId'=>$hotelTripId,
                'tripId'=>session('tripId'),
                'hotelName'=>$accomodationName,
                'aRooms' => $aRooms,
                'aCurrentOccupation' => $aCurrentOccupation,
                'aTravellerPerRoom' =>$aTravellerPerRoom
            ]);
    } 

    /**
     * this function add rooms to a accomodation for a specific trip
     * @author Stefan Segers
     * 
     * @param Request $request
     * @return type
     */    
    function addRooms(Request $request)
    {
        if ($this->hasRights()){
            for ($iNumberOfRooms = 1; $iNumberOfRooms <= $request->post('NumberOfRooms'); $iNumberOfRooms++) {
                $iHotelTripId = session('hotelTripId');
                $iOccupation = $request->post('NumberOfPeople');
                $this->rooms->addRoom($iHotelTripId, $iOccupation);
            }
            return redirect()->back(); 
        }else{
            return redirect()->back()->with('errormessage', 'je hebt onvoldoende rechten voor deze bewerking');
        }        
    }
    
    /**
     * this function delete a room from an accomodation for a specific trip
     * 
     * @author Stefan Segers
     * @param type $roomId
     * @return type
     */
    function deleteRoom($roomId)
    {        
        if ($this->hasRights()){
            $this->rooms->deleteRoom($roomId);
            return redirect()->back();
        }else{
            return redirect()->back()->with('errormessage', 'je hebt onvoldoende rechten voor deze bewerking');
        } 
    }
    
    /**
     * This function adds a user to a hotel room
     *
     * @author Stefan Segers
     *
     * @param integer $roomId
     * @return \Illuminate\Http\RedirectResponse
     */
    function selectRoom($roomId){
        $oUser = Auth::user();
        if($oUser->role=='admin'){
            return redirect()->back()->with('errormessage', 'U kunt geen kamer kiezen als administrator');
        }
        else{
            $travellerId=$oUser->traveller->traveller_id;
            $hotelTripId = session('hotelTripId');
            //check if already has room for this hotel_trip
            $hasRoom = $this->rooms->hasRoom($travellerId,$hotelTripId);

            if (!$hasRoom){
                $this->rooms->addTravellerToRoom($travellerId,$roomId);
                return redirect()->back();
            }else{
                return redirect()->back()->with('errormessage', 'U heeft al een kamer gekozen in dit hotel');
            }
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
    function leaveRoom($roomId,$travellerId = null){
        $oUser = Auth::user();
        if ($oUser->role=='admin'){
            $this->rooms->deleteTravellerFromRoom($roomId,$travellerId);
            return redirect()->back()->with('successmessage', 'De reiziger kan nu een andere kamer kiezen');
        }
        else{
            $travellerId=$oUser->traveller->traveller_id;
            $this->rooms->deleteTravellerFromRoom($roomId,$travellerId);
            return redirect()->back()->with('successmessage', 'U kunt nu een andere kamer kiezen');
        }
    }
}
