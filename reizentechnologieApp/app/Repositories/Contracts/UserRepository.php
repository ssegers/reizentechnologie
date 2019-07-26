<?php
namespace App\Repositories\Contracts;

/**
 * Description of TravellerRepository
 *
 * @author u0067341
 */
interface UserRepository {
    
    /**
     * get user based on the username
     * 
     * @param $sUserName the username
     * @return $aProfileData all Traveller Data
     */
    public function get($sUserName);
    
    /**
     * update the user data based on the given array
     *
     * @param $aUserData all User Data
     */    
    public function update($aUserData,$userId);

    /**
     * get user resettoken based on the user_id
     * 
     * @param $iUserId the user_id
     * @return $aProfileData all Traveller Data
     */
    public function getResetToken($sUserName);
}