<?php

namespace App\Repositories\Eloquent;
use App\Repositories\Contracts\TravellerRepository;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Traveller;
use App\Models\Trip;
use App\Models\Payment;


/**
 * Description of EloquentTraveller
 *
 * @author u0067341
 */
class EloquentTraveller implements TravellerRepository 
{
    /**
     * Insert new record into user table and traveller table
     * 
     * @author Stefan Segers
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
     * get All travellerdata as an array based on the user_id
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
        $profileDataCollection = collect($aProfileData);
        return $profileDataCollection;
    }
    
    /**
     * get userId by username
     * @param string the username (u,r or b nummer)
     * @return integer the userId
     */    
    public function getIdByUsername($sUsername)
    {
        return User::where('username',$sUsername)->first()->user_id;
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
     * change the trip the attendant is part of
     * 
     * @author Stefan Segers
     *
     * @param integer $userId
     * @param integer $tripIdOld
     * @param integer $tripIdNew
     * @return 
     */ 
   
    public function changeTrip($iUserId, $iTripIdOld, $iTripIdNew){

        $oTrip = Traveller::where('user_id',$iUserId)->first()
                ->trips()->wherePivot('trip_id',$iTripIdOld)->first();
            if ($oTrip != null){
                $oTrip->pivot->trip_id = $iTripIdNew;
                $oTrip->pivot->save();
            }
        return true;
    }
    
    /**
     * Deletes the data of a selected traveller
     *
     * @author Stefan Segers
     *
     * @param $sUserName
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|string
     */
    public function destroy($sUserName){
        $oUser = User::where('username', $sUserName)->firstOrFail();
        $oUser->delete();
    }
    
    /**
     * check if loggedin user is organiser for the given trip
     * @author Stefan Segers
     * @param intger $iTripid the trip_id
     * @return boolean $isOrganizer 
     */
    public function isOrganizerForTheTrip($iTripId){
        $bIsOrganizer = FALSE;
        $oUser = Auth::user();
        if ($oUser->role == 'admin') {
            $bIsOrganizer = true;
        }elseif($oUser->role == 'guide'){ 
            $oTrip = Traveller::where('user_id',$oUser->user_id)->first()
                ->trips()->wherePivot('trip_id',$iTripId)->first();
            if ($oTrip != null){
                $bIsOrganizer = $oTrip->pivot->is_organizer;
            }
        }
        return $bIsOrganizer;
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

//        $allTravellerData = Traveller::whereHas('trips', function ($q) use ($iTripId) {
//            $q->where('trips.trip_id', $iTripId);})
//            ->with(['user','zip','major','major.study'])
//            ->get();
//        foreach($allTravellerData as $travellerData){    
//        $aData = $travellerData->attributesToArray();
//        $aData = array_merge($aData,$travellerData->User->attributesToArray());
//        $aData = array_merge($aData,$travellerData->Zip->attributesToArray());
//        $aData = array_merge($aData,$travellerData->Major->attributesToArray());
//        //$aData = array_merge($aData,$$travellerData->Major->Study->attributesToArray());
//        $aAllData[]=$aData;
//        }
//        //$aData = array_merge($aData,$travellers->Trips[0]->attributesToArray());
//        $dataCollection = collect($aAllData)->only(array_keys($aDataFields))->all();
//         dd($allTravellerData,$dataCollection);
        $travellerData = Traveller::select(array_keys($aDataFields))
                ->join('users','travellers.user_id','=','users.user_id')
                ->join('zips','travellers.zip_id','=','zips.zip_id')
                ->join('majors','travellers.major_id','=','majors.major_id')
                ->join('traveller_trip', 'travellers.traveller_id', '=', 'traveller_trip.traveller_id')
                ->join('studies','majors.study_id','=','studies.study_id')
                ->where('trip_id', $iTripId)
                ->orderBy('role', 'asc')
                ->orderBy('major_name', 'asc')
                ->orderBy('last_name', 'asc')
                ->get()->toArray();

        return $travellerData;
        }     
        
        
        public function getPaymentData($iTripId){
            $aTripData = Trip::where('trip_id',$iTripId)->select('trip_id','price')->first()->attributesToArray();
            $travellers = Trip::where('trip_id', $iTripId)->first()->travellers()
                    ->select('travellers.traveller_id','user_id','first_name','last_name','iban')
                    ->withCount(['payments AS totalpaid' => function($query) use ($iTripId) {
                        $query->select(DB::raw("SUM(amount)"))->where('trip_id', $iTripId);}])
                    ->get();
                        
            foreach($travellers as $traveller){
                $aPaymentData[$traveller->traveller_id] = $traveller->attributesToArray();
                $aPaymentData[$traveller->traveller_id] = array_merge($aPaymentData[$traveller->traveller_id],$traveller->User->attributesToArray());
                $aPaymentData[$traveller->traveller_id] = array_merge($aPaymentData[$traveller->traveller_id],$aTripData);
            }
            return $aPaymentData;
        } 
        
        public function getPayments($iTripId,$iTravellerId)
        {
            $aPaymentsPerUser = Payment::where([
                ['traveller_id', '=', $iTravellerId],
                ['trip_id', '=', $iTripId],
                ])->orderBy('date_of_payment', 'asc')->get();

        return $aPaymentsPerUser;
        }
        
        public function deletePayment($iPaymentId) {
            Payment::destroy($iPaymentId);
            return true;
        }
        
        public function addPayment($aPaymentData) {
            $oPayment = new Payment;
            $oPayment->traveller_id = $aPaymentData['traveller_id'];
            $oPayment->trip_id = $aPaymentData['trip_id'];
            $oPayment->amount = $aPaymentData['amount'];
            $oPayment->date_of_payment = $aPaymentData['date_of_payment'];
            $oPayment->save();
            return true;
        }


        /**
         * get full username by user id
         * 
         * @author Koen De Deckers
         * 
         * @param $sUserId
         * @return string
         */
        public function getFullNameByUserId($sUserId) {
            $traveller = Traveller::where('user_id', $sUserId)->get()->first();
            return $traveller->first_name . " " . $traveller->last_name;
        }
    }