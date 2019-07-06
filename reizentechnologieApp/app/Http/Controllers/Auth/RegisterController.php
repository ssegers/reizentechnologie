<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Http\Requests\RegistrationFormStep1Post;
use App\Http\Requests\RegistrationFormStep2Post;
use App\Http\Requests\RegistrationFormStep3Post;
use App\Http\Requests\RegistrationFormAddZip;

use Illuminate\Support\Facades\Mail;
use App\Mail\TripRegistrationConfirmation;

use App\Repositories\Contracts\StudieRepository;
use App\Repositories\Contracts\CityRepository;
use App\Repositories\Contracts\TripRepository;
use App\Repositories\Contracts\TravellerRepository;


class RegisterController extends Controller
{
    
    /**
     *
     * @var studieRepository
     */
    private $studies;
 
   /**
     *
     * @var cityRepository
     */
    private $cities;
    
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
    
    
    /**
     * @author Daan Vandebosch
     * @return \Exception|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     * Get's register session data and saves it to database.
     */
    function __construct(StudieRepository $studie, CityRepository $citie, TripRepository $trip, TravellerRepository $traveller) {
        $this->middleware('auth');
        $this->middleware('guest');

        $this->studies = $studie;
        $this->cities = $citie;
        $this->trips = $trip;
        $this->travellers = $traveller;
        
        try{
            session_start();
        }
        catch (\Exception $ex){
            session_reset();
        }
    }
    
    public function createZip(RegistrationFormAddZip $request)
    {
        //incomming data is already validade by the specific request type
        //Get the input

        $aData['zip_code'] = $request->post('zip_code');
        $aData['city'] = $request->post('city');
        
        //Insert new record into zips table
        $newCity = $this->cities->store($aData);

        return response()->json(['zipAdded' => true,'zip_id'=>$newCity->zip_id,'zip_code'=>$newCity->zip_code,"city"=>$newCity->city]);
    }
    
    /**
     * Gets the travellers, trip, majors and studies and returns them with the step1 view
     * 
     * @author Sasha Van de Voorde & Nico Schelfhout
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 
     */
    public function step0()
    {
        return view('user.registrationform.step0');
    }

    public function step0Post() 
    {
        return redirect('/user/registrationform/step-1');
    }

    public function step1(Request $request) 
    {
        $aTrips = $this->trips->getAllActive();
        foreach ($aTrips as $oTrip){
            $aTripSelectList[$oTrip->trip_id] = $oTrip->name." ".$oTrip->year;
        }
        $aStudies = $this->studies->get();
        foreach ($aStudies as $oStudy){
            $aStudySelectList[$oStudy->study_id] = $oStudy->study_name;
        }

        /* Get majors according to the selected study */
        $iSelectedStudyId = $request->session()->get('iSelectedStudyId', '');
        $aMajors = $this->studies->getMajorsByStudy( $iSelectedStudyId);

        return view('user.registrationform.step1', [
            'aTrips' => $aTripSelectList,
            'aStudies' => $aStudySelectList,
            'aMajors' => $aMajors,
            'sEnteredUsername' => $request->session()->get('sEnteredUsername', ''),
            'iSelectedTripId' => $request->session()->get('iSelectedTripId', ''),
            'iSelectedStudyId' => $request->session()->get('iSelectedStudyId', ''),
            'iSelectedMajorId' => $request->session()->get('iSelectedMajorId', ''),
        ]);
    }
    
    /**
     * Validates the request data, puts the request data in a traveller and puts it in the session returns a redirect to step 2
     * 
     * @author Sasha Van de Voorde & Nico Schelfhout
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * 
     */
    public function step1Post(RegistrationFormStep1Post $request) 
    {    
        /* Put all user input in the session */
        $request->session()->put('sEnteredUsername', $request->post('txtStudentNummer'));
        $request->session()->put('iSelectedTripId', $request->post('dropReis'));
        $request->session()->put('iSelectedStudyId', $request->post('Study'));
        $request->session()->put('iSelectedMajorId', $request->post('Major'));

        /* Save succesfull validation of the form in session */
        $request->session()->put('validated-step-1', true);

        return redirect('/user/registrationform/step-2');
    }

    /**
     * Gets the traveller from the session, gets zip codes, cities and returns the step 2 view
     * 
     * @author Sasha Van de Voorde & Nico Schelfhout
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 
     */
    public function step2(Request $request) 
    {
        if ($request->session()->get('validated-step-1') != true) {
            return redirect('user/registrationform/step-1');
        }

        $aCities = $this->cities->get();

        $aGenderOptions = array(
            'man' => 'Man',
            'vrouw' => 'Vrouw',
            'anders' => 'Anders',
        );

        return view('user.registrationform.step2',[
            'aCities' => $aCities,
            'aGenderOptions' => $aGenderOptions,
            'sEnteredLastName' => $request->session()->get('sEnteredLastName', ''),
            'sEnteredFirstName' => $request->session()->get('sEnteredFirstName', ''),
            'sCheckedGender' => $request->session()->get('sCheckedGender', ''),
            'sEnteredNationality' => $request->session()->get('sEnteredNationality', ''),
            'sEnteredBirthDate' => $request->session()->get('sEnteredBirthDate', ''),
            'sEnteredBirthPlace' => $request->session()->get('sEnteredBirthPlace', ''),
            'sEnteredAddress' => $request->session()->get('sEnteredAddress', ''),
            'iSelectedCityId' => $request->session()->get('iSelectedCityId', 0),
            'sEnteredCountry' => $request->session()->get('sEnteredCountry', ''),
            'sEnteredIban' => $request->session()->get('sEnteredIban', ''),
            'sEnteredBic' => $request->session()->get('sEnteredBic', ''),
        ]);
    } 
   
    /**
     * 
     * Validates the request data and puts the data in a traveller then puts it in the session.
     * Returns a redirect to the next step in the form
     * @author Sasha Van de Voorde & Nico Schelfhout
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * 
     */
    public function step2Post(RegistrationFormStep2Post $request) 
    {   
        /* Put all the data in the session */
        $request->session()->put('sEnteredLastName', $request->post('txtNaam'));
        $request->session()->put('sEnteredFirstName', $request->post('txtVoornaam'));
        $request->session()->put('sCheckedGender', $request->post('gender'));
        $request->session()->put('sEnteredNationality', $request->post('txtNationaliteit'));
        $request->session()->put('sEnteredBirthDate', $request->post('dateGeboorte'));
        $request->session()->put('sEnteredBirthPlace', $request->post('txtGeboorteplaats'));
        $request->session()->put('sEnteredAddress', $request->post('txtAdres'));
        $request->session()->put('iSelectedCityId', $request->post('dropGemeentes'));
        $request->session()->put('sEnteredCountry', $request->post('txtLand'));
        $request->session()->put('sEnteredIban', $request->post('txtBank'));
        $request->session()->put('sEnteredBic', $request->post('txtBic'));

        /* Save succesfull validation of the form in session */
        $request->session()->put('validated-step-2', true);

        return redirect('/user/registrationform/step-3');
    }
    
    /**
     * Gets the traveller from the session and returns it with the step3 view
     * 
     * @author Sasha Van de Voorde & Nico Schelfhout
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 
     */
    public function step3(Request $request) 
    {
        if ($request->session()->get('validated-step-2') != true) {
            return redirect('user/registrationform/step-2');
        }
        //get type of user to determine witch email extention to use and store into session
        $cTypeOfUser = strtolower($request->session()->get('sEnteredUsername')[0]);
        
        switch ($cTypeOfUser) {          
            /* Docent */
            case 'u':
                $sEmailDomain = 'ucll.be';
                $request->session()->put('sTypeOfUser', 'docent');
                break;
            /* Extern */
            case 'b':
                $sEmailDomain = $request->session()->get('sEmailExtension', false);
                $request->session()->put('sTypeOfUser', 'attendant');
                break;
            /* Student */
            default:
                $sEmailDomain = 'student.ucll.be';
                $request->session()->put('sTypeOfUser', 'student');
                break;
        }

        return view('user.registrationform.step3', [
            'sEmailDomain' => $sEmailDomain,
            'sEnteredEmailLocalPart' => $request->session()->get('sEnteredEmailLocalPart', ''),
            'sEnteredMobile' => $request->session()->get('sEnteredMobile', ''),
            'sEnteredEmergency1' => $request->session()->get('sEnteredEmergency1', ''),
            'sEnteredEmergency2' => $request->session()->get('sEnteredEmergency2', ''),
            'bCheckedMedicalCondition' => $request->session()->get('bCheckedMedicalCondition', false),
            'sEnteredMedicalCondition' => $request->session()->get('sEnteredMedicalCondition', ''),
        ]);
    }
    
    public function step3Post(RegistrationFormStep3Post $request) 
    {

        /* Put all the data in the session */
        $request->session()->put('sEnteredEmailLocalPart', $request->post('txtEmailLocalPart'));
        $request->session()->put('sEmailDomain', $request->post('txtEmailDomain'));
        $request->session()->put('sEmail',$request->input('txtEmail'));
        $request->session()->put('sEnteredMobile', phone($request->post('txtGsm'), array('BE','NL'), 'E164'));
        $request->session()->put('sEnteredEmergency1',phone($request->post('txtNoodnummer1'), array('BE','NL'), 'E164'));
        //noodnummer 2 is geen vereist veld
        if ($request->post('txtNoodnummer2') != null){
            $request->session()->put('sEnteredEmergency2', phone($request->post('txtNoodnummer2'), array('BE','NL'), 'E164'));
        }
        $request->session()->put('bCheckedMedicalCondition', $request->post('radioMedisch'));
        $request->session()->put('sEnteredMedicalCondition', $request->post('txtMedisch'));

        /* Save succesfull validation of the form in session */
        $request->session()->put('validated-step-3', true);

        $sTypeOfUser = $request->session()->get('sTypeOfUser');

        /* 
         * Create the new user/traveller and link to the selected trip
         * 
         */
        
        /* Create the user/traveller */
        $aUserData['username'] = $request->session()->get('sEnteredUsername');
        $aUserData['password'] = bcrypt($sRandomPass = Str::random());
       
        if ($sTypeOfUser == 'docent' or $sTypeOfUser == 'attendant') {
            $aUserData['role'] = 'guide';
        } else {
            $aUserData['role'] = 'traveller';
        }
 
        $aUserData['major_id'] = $request->session()->get('iSelectedMajorId');
        $aUserData['first_name'] = $request->session()->get('sEnteredFirstName');
        $aUserData['last_name'] = $request->session()->get('sEnteredLastName');
        $aUserData['email'] = $request->session()->get('sEmail');
        $aUserData['country'] = $request->session()->get('sEnteredCountry');
        $aUserData['address'] = $request->session()->get('sEnteredAddress');
        $aUserData['zip_id'] = $request->session()->get('iSelectedCityId');
        $aUserData['gender'] = $request->session()->get('sCheckedGender');
        $aUserData['phone'] = $request->session()->get('sEnteredMobile');
        $aUserData['emergency_phone_1'] = $request->session()->get('sEnteredEmergency1');
        $aUserData['emergency_phone_2'] = $request->session()->get('sEnteredEmergency2');
        $aUserData['nationality'] = $request->session()->get('sEnteredNationality');
        $aUserData['birthdate'] = $request->session()->get('sEnteredBirthDate');
        $aUserData['birthplace'] = $request->session()->get('sEnteredBirthPlace');
        $aUserData['iban'] = $request->session()->get('sEnteredIban');
        $aUserData['bic'] = $request->session()->get('sEnteredBic');
        $aUserData['medical_issue'] = $request->session()->get('bCheckedMedicalCondition');
        $aUserData['medical_info'] = $request->session()->get('sEnteredMedicalCondition');
        $aUserData['trip_id'] = $request->session()->get('iSelectedTripId');

        $this->travellers->store($aUserData);

        /* send mail */
        $oTrip =$this->trips->get($aUserData['trip_id']);
        $sTripName = $oTrip->name." ".$oTrip->year;
        $aMailData = [
            'name' => $aUserData['first_name'].' '.$aUserData['last_name'],
            'trip' => $sTripName,
            'username' => $aUserData['username'],
            'email' => $aUserData['email'],
            'password' => $sRandomPass
        ];

        Mail::to($aMailData['email'])->send(new TripRegistrationConfirmation($aMailData));

        /* set succes message and flush all data from session*/
        $sMessage = '<p>Je hebt je succesvol geregistreerd voor de '.$sTripName.' reis.</p>';
        $sMessage .= '<p>Je hebt hiervan een bevestigingsmail gekregen met hierin je login gegevens.</p>';
        $sMessage .= '<p>Indien je deze mail niet hebt ontvangen stuur een bericht via het contact formulier op deze site</p>.';
        $request->session()->flush();
        session_reset();

        Auth::logout();
        
        return redirect('/')->with('message', $sMessage);
    }        
}