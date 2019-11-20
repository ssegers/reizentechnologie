<?php
namespace App\Repositories\Contracts;

/**
 * Description of TravellerRepository
 *
 * @author u0067341
 */
interface AccomodationRepository {
    

    
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
    public function storeAccomodation($aData);
    
    /**
     * delete accomodation
     * 
     * @return 
     */
    public function deleteAccomodation($iId);        
}