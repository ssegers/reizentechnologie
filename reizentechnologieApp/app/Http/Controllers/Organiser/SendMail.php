<?php

namespace App\Http\Controllers\Organiser;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

use App\Repositories\Contracts\TripRepository;
use App\Repositories\Contracts\TravellerRepository;

use App\Mail\InformationMail;
use App\Http\Requests\SendMailForm;

class SendMail extends Controller
{
    
    /**
     *
     * @var tripRepository
     */
    private $trips;
    
    /**
     *
     * @var TravellerpRepository
     */
    private $travellers;    
    /**
     * SendMail Constructor
     * 
     * @param travellerRepository $traveller
     * @param tripRepository $trip
     */
    public function __construct(TripRepository $trip, TravellerRepository $traveller) 
    {
       $this->trips = $trip;
       $this->travellers = $traveller;
    }    


    /**
     * This method shows the email form 
     *
     * @author Stef Kerkhofs
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */    
    public function getEmailForm()
    {
        //get the current user
        $oUser = Auth::user();
        //redirect if no rights to send emails
        if (($oUser->role == 'admin') || ($oUser->role != 'guide')){
            return redirect('info');
        }
        
        $sEmail = $oUser->traveller->email;
        $aActiveTripsByOrganiser = $this->trips->getActiveByOrganiser($oUser->user_id);
        $aTrips = array();
        foreach ($aActiveTripsByOrganiser as $oTrip) {
            $aTrips[$oTrip->trip_id] = $oTrip->name . ' ' . $oTrip->year;
        }
        return view('mails.informationmailform', ['aTrips' => $aTrips, 'sEmail' => $sEmail]);

    }


    /**
     * This method validates and sends the update mail
     *
     * @author Yoeri op't Roodt & Stef Kerkhofs
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendInformationMail(SendMailForm $request)
    {
        if(Auth::user()->role == "admin"){
            return back()->with('danger','U kan geen mail versturen als administrator');
        }
        $sContactMail =  $request->post('contactMail');
        $iTripId = $request->post('trip');

        /* Set the mail data */
        $aMailData = [
            'subject' => $request->post('subject'),
            'trip' => $this->trips->get($iTripId),
            'message' => $request->post('message'),
            'contactMail' => $sContactMail
        ]; 

        if (($request->post('test')) == 'sendTestMail'){
             Mail::to($sContactMail)->send(new InformationMail($aMailData));
        }else{
            /* Get the mail list and chunk them by 10 */
            $aAllTravellersPerTrip = $this->travellers->getTravellersDataByTrip($iTripId, ['email' => 'email','first_name' => 'first_name','last_name' => 'last_name']);
            foreach( $aAllTravellersPerTrip as $aTraveller){
                $aRecipient['email'] = $aTraveller['email'];
                $aRecipient['name'] = $aTraveller['first_name']. ' ' .$aTraveller['last_name'];
                $aMalingList[] = $aRecipient;
            }
            $aChunkMalingList = array_chunk($aMalingList, 10);
            /* Send the mail to each recipient */
            foreach ($aChunkMalingList as $aChunk) {
                //dd($aChunk);
                Mail::to($aChunk)->send(new InformationMail($aMailData));
            }           
        }
        return redirect()->back()->with('message', 'De email is succesvol verstuurd!');
    }

}
