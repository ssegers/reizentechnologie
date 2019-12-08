<?php

namespace App\Repositories\Eloquent;
use App\Repositories\Contracts\AccomodationRepository;
use Illuminate\Support\Facades\DB;

use App\Models\Trip;
use App\Models\Hotel;

/**
 * accessing trip data
 *
 * @author u0067341
 */
class EloquentAccomodation implements AccomodationRepository
{
    /**
     * get the accomodation name
     * 
     * @return string
     */
    public function getAccomodationName($accomodationId)
    {
        $accomodation = Hotel::where('hotel_id',$accomodationId)
                ->first(['hotel_name']);//->pluck('hotel_name');
        if (!$accomodation){
            return false;
        }else{
            return $accomodation->hotel_name;
        }
    }
    
    /**
     * get all accomodations for a specific trip
     * 
     * @return collection
     */    
    public function getAccomodationsPerTrip($iTripId) {
        $accomodations = Trip::where('trip_id',$iTripId)->first()->accomodations()->orderBy('start_date','asc')->get();
        return $accomodations;   
    }    
  

    /**
     * get all accomodations for a specific destination
     * 
     * @return collection
     */
    public function getAccomodationsByDestination($sDestinationName)
    {
        $accomodations = Hotel::where('trip_destination',$sDestinationName)->get();
        
        if (!$accomodations->isempty()){
            foreach ($accomodations as $accomodation){
                $aKeys[] = $accomodation->hotel_id;
                $aValues[] = $accomodation;
            }
            $accomodations = collect(array_combine($aKeys, $aValues));
        }
        return $accomodations;
    }
    
    /**
     * add accomodations to trip
     * 
     * @return 
     */
    public function addAccomodationsToTrip($aData)
    {
        $trip = Trip::find($aData['trip_id']);
        $trip->accomodations()->attach($aData['hotel_id'],['start_date' => $aData['start_date'], 'end_date' => $aData['end_date']]);
        return true;
    }
    
    /**
     * store new accomodation
     * 
     * @return 
     */
    public function storeAccomodation($request)
    {
        $accomodation = new Hotel();
        $accomodation->hotel_name = $request->AccomodationName;
        $accomodation->trip_destination = $request->Destination;
        $accomodation->type_of_accomodation = $request->TypeOfAccomodation;
        $accomodation->address = $request->Address;
        $accomodation->phone = $request->Phone;
        $accomodation->email = $request->EmailAccomodation;
        $accomodation->website_link = $request->WebsiteAccomodation;
        $accomodation->picture1_link = $request->AccomodationImage1;
        $accomodation->picture2_link = $request->AccomodationImage2;
        $accomodation->save();
        return true;
    }

    /**
     * update accomodation
     * 
     * @return 
     */
    public function updateAccomodation($request)
    {
        $accomodation = Hotel::find($request->AccomodationId);
        $accomodation->hotel_name = $request->AccomodationName;
        $accomodation->trip_destination = $request->Destination;
        $accomodation->type_of_accomodation = $request->TypeOfAccomodation;
        $accomodation->address = $request->Address;
        $accomodation->phone = $request->Phone;
        $accomodation->email = $request->EmailAccomodation;
        $accomodation->website_link = $request->WebsiteAccomodation;
        $accomodation->picture1_link = $request->AccomodationImage1;
        $accomodation->picture2_link = $request->AccomodationImage2;
        $accomodation->save();
    }
    
    /**
     * delete accomodation
     * 
     * @return 
     */
    public function deleteAccomodationFromTrip($iId)
    {
        //onderstaande lukt niet met eloquent detach omdat dan alle rijen met 
        //dezelfde accomodatie worden gewist en dit is niet de bedoeling.
        //met eloquent detach kan je niet wissen op basis van het id van de
        //pivot table
        $sqlDelete = "delete from hotel_trip where id=$iId";
        DB::select($sqlDelete);

        return true;
    }
}