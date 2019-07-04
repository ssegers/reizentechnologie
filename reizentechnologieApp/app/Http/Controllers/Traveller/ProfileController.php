<?php

namespace App\Http\Controllers\Traveller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\ProfileEdit;

use App\Repositories\Contracts\TravellerRepository;
use App\Repositories\Contracts\TripRepository;
use App\Repositories\Contracts\CityRepository;
use App\Repositories\Contracts\StudieRepository;

class ProfileController extends Controller
{
    /**
     * Shows user Profile
     *
     * @author 
     *
     * @param Request $request
     * @param $sUserName
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     */    

    /**
     *
     * @var travellerRepository
     */
    private $travellers;

    /**
     *
     * @var tripRepository
     */
    private $trips;

    /**
     *
     * @var cityRepository
     */
    private $cities;

    /**
     *
     * @var studieRepository
     */
    private $studies;

    /**
     * ProfileController Constructor
     * 
     * @param travellerRepository $traveller
     * @param tripRepository $trip
     */
    public function __construct(TravellerRepository $traveller, 
            TripRepository $trip, CityRepository $city, StudieRepository $study) 
    {
       $this->traveller = $traveller;
       $this->trips = $trip;
       $this->cities = $city;
       $this->studies = $study;
    }
    
    public function showProfile(Request $request) 
    {
        if (Auth::user()->role == "admin"){
            return redirect(route("info"));
        }
        $usersId = Auth::user()->user_id;     
        $aUserData = $this->traveller->get($usersId);

        return view('user.profile.profile', ['sPath' => $request->path(),'aUserData' => $aUserData]);
    
    }
    
    public function editProfile(Request $request) 
    {
        if (Auth::user()->role == "admin"){
            return redirect(route("info"));
        }
        $usersId = Auth::user()->user_id;     
        $aUserData = $this->traveller->get($usersId);
        $aTrips = $this->trips->getAllActive();
        foreach ($aTrips as $oTrip){
            $aTripSelectList[$oTrip->trip_id] = $oTrip->name." ".$oTrip->year;
        }
        $aStudies = $this->studies->get();
        foreach ($aStudies as $oStudy){
            $aStudySelectList[$oStudy->study_id] = $oStudy->study_name;
        }        

        $oZips = $this->cities->get();
        $aMajors = $this->studies->getMajorsByStudy($aUserData['study_id']);

        return view('user.profile.profileEdit', ['sPath' => $request->path(),'aUserData' => $aUserData, 'aTrips' => $aTripSelectList, 'oZips' => $oZips, 'aStudies' =>  $aStudySelectList, 'aMajors' => $aMajors]);
    }
    
    /**
     * Updates the data of a selected user
     *
     * @author Joren Meynen
     *
     * @param ProfileEdit $aRequest
     * @param $sUserName
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function updateProfile(ProfileEdit $aRequest)
    {
        if (Auth::user()->role == "admin"){
            return redirect(route("info"));
        }
        $userId = Auth::user()->user_id; 
        $aProfileData = [
                    'last_name'         => $aRequest->post('LastName'),
                    'first_name'        => $aRequest->post('FirstName'),
                    'gender'            => $aRequest->post('Gender'),
                    'major_id'          => $aRequest->post('Major'),
                    'iban'              => $aRequest->post('IBAN'),
                    'bic'               => $aRequest->post('BIC'),
                    'medical_issue'     => $aRequest->post('MedicalIssue'),
                    'medical_info'      => $aRequest->post('MedicalInfo'),
                    'birthdate'         => $aRequest->post('BirthDate'),
                    'birthplace'        => $aRequest->post('Birthplace'),
                    'nationality'       => $aRequest->post('Nationality'),
                    'address'           => $aRequest->post('Address'),
                    'zip_id'            => $aRequest->post('City'),
                    'country'           => $aRequest->post('Country'),
                    'phone'             => $aRequest->post('Phone'),
                    'emergency_phone_1' => $aRequest->post('icePhone1'),
                    'emergency_phone_2' => $aRequest->post('icePhone2'),
                ];
        $this->traveller->update($aProfileData,$userId);
        
        if(str_contains($aRequest->path(), 'profile')){
            return redirect()->route('profile');
        }
        return redirect('userinfo/'. $sUserName);
    }
}
