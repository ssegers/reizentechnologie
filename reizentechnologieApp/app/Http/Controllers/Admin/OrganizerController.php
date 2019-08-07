<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Repositories\Contracts\TripRepository;
use App\Repositories\Contracts\UserRepository;

class OrganizerController extends Controller
{
    /**
     *
     * @var TripRepository
     */
    private $trips;

    /**
     *
     * @var TravellerRepository
     */
    private $users;    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(TripRepository $trip, UserRepository $user)
    {
        $this->trips = $trip;
        $this->users = $user;
    }    

    /**
     * This function will show the ActiveTripOrganizer view
     * 
     * @author Segers Stefan
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 
     */
    public function show($iTripId = 0) 
    {
        $aActiveTrips = $this->trips->getAllActive();
        foreach ($aActiveTrips as $oTrip){
            $aTripSelectList[$oTrip->trip_id] = $oTrip->name." ".$oTrip->year;
        }
        $aGuides = $this->users->getGuides();
        if($iTripId != 0){
            $aOrganizers = $this->trips->getOrganizersByTrip($iTripId);
        }else{
            $aOrganizers = [];
        }
        return view( 'admin.organizers.showOrganizer',
            [
                'aActiveTrips' => $aTripSelectList,
                'iTripId' => $iTripId,
                'aGuides' => $aGuides,
                'aOrganizers' => $aOrganizers,
                ]);
    }

}
