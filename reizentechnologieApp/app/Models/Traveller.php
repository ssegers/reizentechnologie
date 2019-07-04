<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Traveller extends Model
{
    protected $guarded = ['traveller_id'];
    protected $primaryKey = 'traveller_id';

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'user_id');
    }

    public function zip()
    {
        return $this->belongsTo('App\Models\Zip', 'zip_id', 'zip_id');
    }

    public function major()
    {
        return $this->belongsTo('App\Models\Major', 'major_id', 'major_id');
    }
    
    public function trips()
    {
        return $this->belongsToMany(Trip::class,null,'traveller_id','trip_id')
            ->withTimestamps()
            ->withPivot(['is_guide','is_organizer']);
    }


//    public function travellersPerRoom()
//    {
//        return $this->hasMany('App\Models\TravellersPerRoom', 'traveller_id', 'traveller_id');
//
//    }
    public $timestamps = false;

    /**
     * Array with data from different tables
     *
     * @author Nico Schelfhout
     *
     * @return mixed
     */
    public static function getTravellersWithPayment($iTripId){
        $userdata= self::select('last_name','first_name', 'iban', 'price', 'amount', 'traveller_trip.traveller_id', 'username')
            ->join('users','travellers.user_id','=','users.user_id')
            ->join('majors','travellers.major_id','=','majors.major_id')
            ->join('traveller_trip', 'travellers.traveller_id', '=', 'traveller_trip.traveller_id')
            ->join('studies','majors.study_id','=','studies.study_id')
            ->join('trips', 'traveller_trip.trip_id','=', 'trips.trip_id')
            ->join('payments', 'travellers.traveller_id','=','payments.traveller_id')
            ->where('traveller_trip.trip_id', $iTripId) ->where(function ($query) {
                $query
                    ->where('is_guide', true)
                    ->orWhere('role', '=', 'traveller');})
            ->groupBy('traveller_trip.traveller_id', 'price', 'amount')->get()->toArray();

        return $userdata;
    }
}
