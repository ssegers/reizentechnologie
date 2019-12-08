<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;
    /**
     * The attributes that sets the primary-key.
     *
     * @var string
     */
    protected $primaryKey = 'user_id';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'password', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
          
    /* set relation to traveller table */
    public function traveller()
    {
        return $this->hasOne('App\Models\Traveller', 'user_id', 'user_id');
    }
    
    public static function isOrganizer()
    {
        $oUser = Auth::user();
        if($oUser->role=='admin'){
            return true;
        }elseif($oUser->role =='guide'){
            foreach($oUser->traveller->trips->where('is_active', true) as $oTrip){
                if ($oTrip->pivot->is_organizer == true){
                    return true;
                }       
            }
        }
        return false;

    }
}
