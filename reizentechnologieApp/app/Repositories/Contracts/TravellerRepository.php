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
    
    public function getIdByUsername($sUsername);
    
    /**
     * get All travellerdata in one array based on the user_id
     * @param $userId the user_id
     * @return $aProfileData all Traveller Data
     */
    public function get($userId);

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
    public function getTravellersDataByTrip($iTripId, $aDataFields);

    /**
     * update travellerdata where user_id = $userid
     * @param $userId the user_id
     * @param $aProfileData all Traveller Data as an array with database 
     *    fieldnames as index
     */ 
    public function update($aProfileData,$userId);
   
    /**
     * change the trip the attendant is part of
     * 
     * @author Stefan Segers
     *
     * @param integer $userId
     * @param integer $tripIdOld
     * @param integer $tripIdNew
     * @return 
     */   
    public function changeTrip($iUserId, $iTripIdOld, $iTripIdNew);
   /**
     * Deletes the data of a selected traveller
     *
     * @author Stefan Segers
     *
     * @param $sUserName
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|string
     */
    public function destroy($sUserName);
    
    /**
     * check if loggedin user is organiser for the given trip
     * 
     * @param intger $tripid the trip_id
     * @return boolean $isOrganizer 
     */
    public function isOrganizerForTheTrip($iTripId); 
    
    public function getPaymentData($iTripId);
    
    public function getPayments($iTripId,$iTravellerId);
    
    public function deletePayment($iPaymentId);
    
    public function addPayment($aPaymentData);

    /**
     * get first name by user id
     * 
     * @author Koen De Deckers
     * 
     * @param $sUserId
     * @return string
     */
    public function getFirstNameByUserId($sUserId);
    /**
     * get last name by user id
     * 
     * @author Koen De Deckers
     * 
     * @param $sUserId
     * @return string
     */
    public function getLastNameByUserId($sUserId);

    /**
     * get traveller id by user id
     * 
     * @author Koen De Deckers
     * 
     * @param $sUserId
     * @return int
     */
    public function getTravellerIdByUserId($sUserId);
    
}
