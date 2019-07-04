<?php
namespace App\Repositories\Contracts;

/**
 * Description of TripRepository
 *
 * @author u0067341
 */
interface TripRepository {
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
     * get attendants per trip
     * @param integer $iTripId 
     * @return $aAttendants
     */    
    public function getAttendantsPerTrip($iTripId);
    /**
     * get attendants per trip
     * @param integer $iTripId 
     * @return $aAttendants
     */
    public function getNumberOfAttendants($iTripId);
    /**
     * get requested data of attendants per trip
     * @param integer $iTripId 
     * @return $aAttendants
     */    
    
    //public function getTravellersDataByTrip($iTripId, $aDataFields, $iPagination = null);
}