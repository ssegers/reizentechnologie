<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\Contracts\StudieRepository;
use App\Repositories\Contracts\TripRepository;
use App\Repositories\Contracts\TravellerRepository;

class DataController extends Controller
{
    /**
     *
     * @var studieRepository
     */
    private $studies;
    
    /**
     *
     * @var tripRepository
     */
    private $trips;

    /**
     *
     * @var travellerRepository
     */
    private $travellers;    
    
    function __construct(StudieRepository $studie, TripRepository $trip, TravellerRepository $traveller) {
        $this->middleware('auth');
        $this->middleware('checkloggedin');

        $this->studies = $studie;
        $this->trips = $trip;
        $this->travellers = $traveller;
    }
    
    /**
     * 
     * @param type $studyId
     * @return type
     */
    public function getMajorsByStudy($studyId)
    {    
        $aMajors = $this->studies->getMajorsByStudy($studyId);
        return json_encode($aMajors);
    }
    
    /**
     * get organizers by trip and result in Json format
     * 
     * @author Stefan Segers
     * @param type $tripId
     * @return type
     */
    public function getOrganizersByTrip($iTripId)
    {   
        $aOrganizers = $this->trips->getOrganizersByTrip($iTripId);
        return response()->json(['aOrganizers' => $aOrganizers]);
    }

    /**
     * 
     * @return type
     */
    public function addOrganizersToTrip(Request $request){

        // this will automatically return a 422 error response when request is invalid
        $this->validate($request, [
            'traveller_ids' => 'required',
            'trip_id' => 'required',
        ]);

        // below is executed when request is valid
        $aTravellerId = $request->post('traveller_ids');
        $iTripId = $request->post('trip_id');

        foreach($aTravellerId as $iTravellerId){
            $this->trips->setTravellerAsTripOrganizer($iTripId, $iTravellerId);
        }

        //$request->session()->flash('message', 'De geselecteerde begeleiders werden aan de geselecteerde reis gekoppeld.');
        return response()->json(['success' => true]);  
    }
  
    public function removeOrganizerFromTrip(Request $request)
    {
        $iTravellerId = $request->post('traveller_id');
        $iTripId = $request->post('trip_id');
        //is_organizer veld op false zetten in TravellersPerTrip
        $this->trips->removeOrganizerFromTrip($iTripId, $iTravellerId);
       // $request->session()->flash('message', 'Het verwijderen van de begeleider is gelukt.');
        return response()->json(['success' => true]);  
    }
    
    public function getPaymentsFromUserByTrip($iTripId,$iTravellerId)
    {
        $aPaymentsPerUser = $this->travellers->getPayments($iTripId, $iTravellerId);
        return response()->json(['aPayments' => $aPaymentsPerUser]);
    }
    
    public function deletePayment(Request $request){
        $iPaymentId = $request->post('payment_id');
        $this->travellers->deletePayment($iPaymentId);
        //return response()->json(['success' => true]);
    }
    
    public function addPayment(Request $request){
        // this will automatically return a 422 error response when request is invalid
        $this->validate($request, [
            'traveller_id' => 'required',
            'trip_id' => 'required',
            'amount' => 'required',
            'payment_date' => 'required',

        ]);

        // below is executed when request is valid
        $aPaymentData['traveller_id'] = $request->post('traveller_id');
        $aPaymentData['trip_id'] = $request->post('trip_id');
        $aPaymentData['amount'] = $request->post('amount');
        $aPaymentData['date_of_payment'] = $request->post('payment_date');
        $this->travellers->addPayment($aPaymentData);

    }

}