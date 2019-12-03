<?php

namespace App\Http\Controllers\Traveller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\RoomRepository;
use App\Repositories\Contracts\AccomodationRepository;
use Illuminate\Support\Facades\Auth;

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
    private $accomodations;
    
    /**
     * roomsController Constructor
     * 
     * @param roomRepository $room
     *
     */
    public function __construct(RoomRepository $room, 
            AccomodationRepository $accomodation) 
    {
       $this->rooms = $room;
       $this->accomodations = $accomodation;
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
        
        $oUser=Auth::user();
        $userTravellerId=$oUser->traveller->traveller_id;
       
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

        return view('user.accomodations.rooms',
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
     * This function adds a user to a hotel room
     *
     * @author Stefan Segers
     *
     * @param integer $roomId
     * @return \Illuminate\Http\RedirectResponse
     */
    function selectRoom($roomId){
        $oUser = Auth::user();
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
        $travellerId=$oUser->traveller->traveller_id;
        $this->rooms->deleteTravellerFromRoom($roomId,$travellerId);
        return redirect()->back()->with('successmessage', 'U kunt nu een andere kamer kiezen');
    }
}
