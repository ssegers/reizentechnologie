<?php
namespace App\Repositories\Contracts;

/**
 * Description of TravellerRepository
 *
 * @author u0067341
 */
interface TravellerRepository {

    /**
     * Insert new record into user table and traveller table
     * @param type $aData
     * @param $aProfileData all Traveller Data as an array with database 
     *    fieldnames as index
     */ 
    public function store($aProfileData);

    /**
     * get All travellerdata in one array based on the user_id
     * @param $userId the user_id
     * @return $aProfileData all Traveller Data
     */
    public function get($userId);

    /**
     * update travellerdata where user_id = $userid
     * @param $userId the user_id
     * @param $aProfileData all Traveller Data as an array with database 
     *    fieldnames as index
     */ 
    public function update($aProfileData,$userId);
    
    /**
     * get traveller by email
     * @param $sEmail the users email
     * @return $oTraveller object of type Traveller
     */
    public function getByEmail($sEmail);
    
    /*
     * Returns the traveller data based on the trip id and requested datafields. Will return a paginated list if requested
     *
     * @author Yoeri op't Roodt
     *
     * @param $iTripId
     * @param $aDataFields
     * @param null $iPagination (optional)
     *
     * @return mixed
     */    
    public function getTravellersDataByTrip($iTripId, $aDataFields, $iPagination = null);
}
