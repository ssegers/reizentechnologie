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

}