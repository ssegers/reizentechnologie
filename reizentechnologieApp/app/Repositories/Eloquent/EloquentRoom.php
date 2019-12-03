<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\RoomRepository;
use App\Models\Room;

/**
 * accessing trip data
 *
 * @author u0067341
 */
class EloquentRoom implements RoomRepository
{
    public function getRoomsPerAccomodationPerTrip($iAccomodationTripId) {
        $rooms = Room::where('hotel_trip_id',$iAccomodationTripId)->get();
        return $rooms;
    }
    
    public function getRoomOccupation($iRoomId)
    {
        $oRoom = Room::where('room_id',$iRoomId)->withcount('travellers')->first();
        return $oRoom->travellers_count;
    }
    
    public function getTravellersPerRoom($iRoomId)
    {
        $travellersPerRoom = Room::find($iRoomId)->travellers()->select('travellers.traveller_id','travellers.first_name','travellers.last_name')->get();
        return $travellersPerRoom;
    }
    
    public function addRoom($iHotelTripId,$iOccupation,$iRoomNumber = null){
        $oRoom=new Room();
        $oRoom->hotel_trip_id = $iHotelTripId;
        $oRoom->size = $iOccupation;
        $oRoom->room_number = $iRoomNumber;
        $oRoom->save();
        return true;
    }
    
    public function deleteRoom($roomId){
        Room::destroy($roomId);
        return true;
    }
    
    public function hasRoom($travellerId,$hotelTripId)
    {
        $rooms = Room::where('hotel_trip_id',$hotelTripId)->get();
        foreach($rooms as $room){
            $traveller = $room->travellers()->wherePivot('traveller_id',$travellerId)->first();
            if ($traveller != null){
                return true;
            }
        }
        return false;
    }
    
    public function addTravellerToRoom($travellerId,$roomId)
    {
        $room = Room::find($roomId)->travellers()->attach($travellerId);
        return true;
    }
    
     public function deleteTravellerFromRoom($roomId,$travellerId)
     {
         Room::find($roomId)->travellers()->detach($travellerId);
         return true;
     }
}