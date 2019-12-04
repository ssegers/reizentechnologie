<?php
namespace App\Repositories\Contracts;

/**
 * Description of TravellerRepository
 *
 * @author u0067341
 */
interface AccomodationRepository {
    
    /**
     * get the accomodation name
     * 
     * @return string
     */
    public function getAccomodationName($accomodationId);
    
    /**
     * get all accomodations for a specific trip
     * 
     * @return collection
     */
    public function getAccomodationsPerTrip($iTripId);

    /**
     * get all accomodations for a specific destination
     * 
     * @return collection
     */
    public function getAccomodationsByDestination($sDestinationName);
    
    /**
     * add accomodations to trip
     * 
     * @return 
     */
    public function addAccomodationsToTrip($aData);
    
    /**
     * store accomodation
     * 
     * @return 
     */
    public function storeAccomodation($data);

    /**
     * update accomodation
     * 
     * @return 
     */
    public function updateAccomodation($data);
    
    /**
     * delete accomodation
     * 
     * @return 
     */
    public function deleteAccomodationFromTrip($iId);        
}