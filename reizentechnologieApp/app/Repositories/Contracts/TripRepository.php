<?php
namespace App\Repositories\Contracts;

/**
 * Description of TripRepository
 *
 * @author u0067341
 */
interface TripRepository {

    /**
     * Insert new record into trip table
     * @param type $aTripData
     */ 
    public function store($aTripData);
    
    /**
     * update record into trip table
     * @param array $aTripData 
     * @param integer $iTripId
     */    
    public function update($aTripData,$iTripId);
    
    /**
     * get all trips
     * @param integer $iTripId
     * @return $oTrip
     */    
     public function getAllTrips();
     
    /**
     * get trip
     * @param integer $iTripId
     * @return $oTrip
     */
    public function get($iTripId);
    
    /**
     * get All active trips
     * 
     * @return $aActiveTrips all Active trips
     */
    public function getAllActive();

   /**
     * get All active trips with value for contact_mail column.
     * @param integer $iTripId 
     * @return $iNumber
     */    
    public function getAllActiveWithContact();
  
    /**
     * get All active trips by Organiser
     * 
     * @return $aActiveTrips all Active trips
     */
    public function getActiveByOrganiser($iUserId);
    
    /**
     * get All active trips for a specific traveller
     * 
     * @return $aActiveTrips all Active trips
     */
    public function getActiveTripsForTraveller($iUserId);    

    /**
     * get attendants per trip
     * @param integer $iTripId 
     * @return $aAttendants
     */    

    public function getNumberOfAttendants($iTripId);
    
    /**
     * get organizers per trip
     * @param integer $iTripId 
     * @return $aOrganizers
     */      
    public function getOrganizersByTrip($iTripId);
    
    /**
     * get all possible drivers for the given trip
     * @author Stefan Segers
     * @param integer $iTripid the trip_id
     * @return collection possibleDrivers 
     */
    public function getPossibleDriversForTheTrip($tripId);
    
    public function setTravellerAsTripOrganizer($iTripId,$iTravellerId);
    
    public function removeOrganizerFromTrip($iTripId,$iTravellerId);
    
    public function getDestinations();
}