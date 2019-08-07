<?php

namespace App\Repositories\Eloquent;
use App\Repositories\Contracts\UserRepository;

use App\Models\User;

/**
 * accessing trip data
 *
 * @author u0067341
 */
class EloquentUser implements UserRepository
{
    public function get($sUserName) {
       return User::where(['username'=> $sUserName])->get();
    }

    /**
     * update the User data based on the given array
     * 
     * @author Stefan Segers
     *
     * @param $aUserData all User Data
     * @return 
     */    
    public function update($aUserData,$userId){
        $test = User::where('user_id',$userId)->update($aUserData);
    }

    public function getResetToken($sUserId) {
        $oResult = User::where('user_id',$sUserId)->first();
        return $oResult->resettoken;
    }
    
    /**
     * get all users that are guide
     * 
     * @return array
     */
    public function getGuides()
    {
        $aGuides = User::where('role','guide')->with('traveller')->get();
        
                $aSubsetOfGuides = $aGuides->map(function ($oGuide) {
                return collect($oGuide->traveller->toArray())
                ->only(['traveller_id', 'first_name', 'last_name'])
                ->all();
            });
        return $aSubsetOfGuides;
    }    
  
}