<?php
namespace App\Repositories\Contracts;

/**
 * Description of TravellerRepository
 *
 * @author u0067341
 */
interface TransportRepository {

    /**
     * add transportation
     * 
     * @return boolean
     */ 
    public function addTransport($tripId,$driverId,$size);
    
   /**
     * delete transportation
     * 
     * @return boolean
     */   
    public function deleteTransport($transportId);
    
    /**
     * get all accomodations for a specific trip
     * 
     * @return collection
     */
    public function getVansPerTrip($iTripId);
        
    /**
     * get the curruent occupation of a van
     * 
     * @return collection
     */
    public function getVanOccupation($vanId);

    /**
     * get all travellers for a van
     * 
     * @return collection
     */
    public function getTravellersPerVan($vanId); 

    /**
     * checks if a travellers has select transport for this trip
     * 
     * @return boolean
     */    
    public function hasTransport($travellerId,$tripId);

    /**
     * adds a travellers to the selected transport
     * 
     * @return boolean
     */      
    public function addTravellerToVan($travellerId,$transportId);
 
    /**
     * remover traveller from the selected transport
     * 
     * @return boolean
     */        
    public function removeFromVan($transportId,$travellerId);
}