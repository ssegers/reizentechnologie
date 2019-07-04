<?php

namespace App\Http\Controllers\GuestAccess;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

use App\Repositories\Contracts\TripRepository;



class ContactPageController extends Controller
{
    /**
     *
     * @var tripRepository
     */
    private $trips;
    
    public function __construct(TripRepository $trip) {
        $this->trips = $trip;
    }
    public function getInfo(){
        $activeTripsWitchContact = $this->trips->getAllActiveWithContact();
        return view('guest.contactpage',array('activeTrips'=>$activeTripsWitchContact));
    }
    public function sendMail(Request $request){
        $request->validate([
            'trip' => 'required',
            'email' => 'required|email',
            'subject' => 'required|max:160',
            'message' => 'required',
            'captcha' => 'required|captcha'
        ],
        [
            'captcha.captcha'=>'Foute captcha code.',
            'trip.required' => 'selecteer een reis uit de lijst',
            'email.required' => 'Geef jouw email adres op',
            'email.email' => 'geen geldig email adres',
            'subject.required' => 'Geef een onderwerp op',
            'message.required' => 'Geef een bericht in',
            'captcha.required' => 'Vul de captcha in'
        ]
        );

        $oSelectedTrip = $this->trips->get((int)$request->post("trip"));
        $mailToAddress = $oSelectedTrip->contact_mail;

        $mailFromAddress = $request->post("email");
        $subject = $request->post("subject");
        $message = $request->post('message');
        $this->sendMailTo($mailToAddress, $subject, $message, $mailFromAddress);
        return redirect()->route('home')->with('message', 'De e-mail is succesvol verzonden.');
    }
    
    public function refreshCaptcha()
    {
        return response()->json(['captcha' => (string)captcha_img()]);
    }
    
    public function sendMailTo($mailToAddress, $subject, $message, $mailFromAddress) {
        $aMailData = [
            'subject' => $subject,
            'email' => $mailToAddress,
            'description' => $message,
            'cmail'=>$mailFromAddress,
        ];
        Mail::to($mailToAddress)->send(new ContactMail($aMailData));
    }



}
