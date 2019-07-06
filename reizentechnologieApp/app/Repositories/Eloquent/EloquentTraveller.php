<?php

namespace App\Repositories\Eloquent;
use App\Repositories\Contracts\TravellerRepository;

use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Traveller;


/**
 * Description of EloquentTraveller
 *
 * @author u0067341
 */
class EloquentTraveller implements TravellerRepository 
{
    /**
     * Insert new record into user table and traveller table
     * @param type $aData
     */
    
    public function store($aData) {
    
        DB::beginTransaction();

        /* Create the User */
        try{
        $oUser = new User;
        $oUser->username = $aData['username'];
        $oUser->password = $aData['password'];
        $oUser->role = $aData['role'];
        $oUser->save();

        $iUserId = User::where('username', $oUser->username)->first()->user_id;
        
       /* Create the traveller */
        
        $oTraveller = new Traveller;
        $oTraveller->user_id = $iUserId;
        $oTraveller->major_id =  $aData['major_id'];
        $oTraveller->first_name =  $aData['first_name'];
        $oTraveller->last_name = $aData['last_name'];
        $oTraveller->email = $aData['email'];
        $oTraveller->country = $aData['country'];
        $oTraveller->address = $aData['address'];
        $oTraveller->zip_id = $aData['zip_id'];
        $oTraveller->gender = $aData['gender'];
        $oTraveller->phone = $aData['phone'];
        $oTraveller->emergency_phone_1 = $aData['emergency_phone_1'];
        $oTraveller->emergency_phone_2 = $aData['emergency_phone_2'];
        $oTraveller->nationality = $aData['nationality'];
        $oTraveller->birthdate = $aData['birthdate'];
        $oTraveller->birthplace = $aData['birthplace'];
        $oTraveller->iban = $aData['iban'];
        $oTraveller->bic = $aData['bic'];
        $oTraveller->medical_issue = $aData['medical_issue'];
        $oTraveller->medical_info = $aData['medical_info'];
        $oTraveller->save();
        
        /* link the traveller to the trip */
        if($aData['role'] == 'guide') {
            $bIsGuide = true;
        }else{
            $bIsGuide = false;
        }
        $oTraveller->trips()->attach($aData['trip_id'],['is_guide' => $bIsGuide, 'is_organizer' => false]);
        
        }catch(\Exception $e)
        {
            DB::rollback();
            throw $e;
        }
        DB::commit();
    }    
    /**
     * get All travellerdata in one array based on the user_id
     * 
     * @author Stefan Segers
     *
     * @param $id the user_id
     * @return $aProfileData all Traveller Data
     */

    public function get($id){
        $travellers = Traveller::with('user' , 'zip', 'major', 'major.study','trips')->where('user_id',$id)->first();

        $aProfileData = $travellers->attributesToArray();
        $aProfileData = array_merge($aProfileData,$travellers->User->attributesToArray());
        $aProfileData = array_merge($aProfileData,$travellers->Zip->attributesToArray());
        $aProfileData = array_merge($aProfileData,$travellers->Major->attributesToArray());
        $aProfileData = array_merge($aProfileData,$travellers->Major->Study->attributesToArray());
        $aProfileData = array_merge($aProfileData,$travellers->Trips[0]->attributesToArray());

        return $aProfileData;
    }

    /**
     * update the traveller data based on the given array
     * 
     * @author Stefan Segers
     *
     * @param $aProfileData all Traveller Data
     * @return 
     */    
    public function update($aProfileData,$userId){
        $oTraveller = Traveller::where('user_id',$userId)->first();

        $oTraveller->update($aProfileData);
    }
    
   /**
     * get traveller by email
     * @param $sEmail the users email
     * @return $oTraveller object of type Traveller
     */
    public function getByEmail($sEmail)
    {
        $oTraveller = Traveller::where('email', $sEmail)->first();
        return $oTraveller;
    }
    
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
     
    public function getTravellersDataByTrip($iTripId, $aDataFields) {
       // voorlopige versie met join en gebruik van de pivot table traveller_trip
        
         //example: filter table

            return Traveller::select(array_keys($aDataFields))
                ->join('users','travellers.user_id','=','users.user_id')
                ->join('zips','travellers.zip_id','=','zips.zip_id')
                ->join('majors','travellers.major_id','=','majors.major_id')
                ->join('traveller_trip', 'travellers.traveller_id', '=', 'traveller_trip.traveller_id')
                ->join('studies','majors.study_id','=','studies.study_id')
                ->where('trip_id', $iTripId)
//                ->where(function ($query) {
//                    $query
//                        ->where('is_guide', true)
//                        ->orWhere('role', '=', 'traveller');})
                ->orderBy('role', 'asc')
                ->orderBy('major_name', 'asc')
                ->orderBy('last_name', 'asc')
                ->get()->toArray();
        }       
  
        

/*        if ($iPagination != null) {
           $trip = Trip:: 
                   where("trip_id" , $iTripId)
// onderstaande geeft geen foutmelding maar heeft ook geen enkel effect                   
//                   ->whereHas('travellers', function ($query) {
//                        $query->whereHas('user', function ($query2) {
//                                $query2->where('role', '=', 'traveller');
//                    });
//                   })
                   ->paginate($iPagination)
                   ->first();

            foreach($trip->travellers as $traveller){
                $aProfileData = $traveller->attributesToArray();
                $aProfileData = array_merge($aProfileData,$traveller->User->attributesToArray());
                $aProfileData = array_merge($aProfileData,$traveller->Zip->attributesToArray());
                $aProfileData = array_merge($aProfileData,$traveller->Major->attributesToArray());
                $aProfileData = array_merge($aProfileData,$traveller->Major->Study->attributesToArray());
                $aUser[] = collect($aProfileData)->only(array_keys($aDataFields));
           }
           $collection = collect($aUser);
           $collection = $collection->sortBy('last_name')->sortBy('role');
        }*/
    }    


