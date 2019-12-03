<?php
namespace App\Repositories\Contracts;

/**
 * Description of TravellerRepository
 *
 * @author u0067341
 */
interface RoomRepository {
    
    
    /**
     * get all rooms for a specific accomodation of a trip
     * 
     * @return collection
     */
    public function getRoomsPerAccomodationPerTrip($iAccomodationTripId);

    /**
     * get the room occupancy
     * 
     * @return integer
     */
    public function getRoomOccupation($iHotelTripId);
    
    public function getTravellersPerRoom($iRoomId);
    
    public function addRoom($iHotelTripId,$iOccupation,$iRoomNumber);
    
    public function deleteRoom($roomId);
    
    public function addTravellerToRoom($travellerId,$roomId);
    
    public function deleteTravellerFromRoom($roomid,$travellerId);
    
    public function hasRoom($travellerId,$hotelTripId);
}