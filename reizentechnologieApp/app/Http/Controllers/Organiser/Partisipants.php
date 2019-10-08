<?php

namespace App\Http\Controllers\Organiser;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Exception;
use Illuminate\Support\Facades\Redirect;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Pdf\Mpdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;

use App\Repositories\Contracts\TravellerRepository;
use App\Repositories\Contracts\TripRepository;
use App\Repositories\Contracts\CityRepository;
use App\Repositories\Contracts\StudieRepository;
use App\Http\Requests\ProfileEdit;

use Illuminate\Support\Facades\Auth;

class Partisipants extends Controller
{
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
       $this->travellers = $traveller;
       $this->trips = $trip;
       $this->cities = $city;
       $this->studies = $study;
    }
    
    
    /* List of all filters */
    protected $aFilterList = [
        'username'=>'Gebruikersnaam',
        'study_name'=>'Richting',
        'major_name'=>'Afstudeerrichting',
        'birthdate' => 'Geboortedatum',
        'birthplace' => 'Geboorteplaats',
        'gender' => 'Geslacht',
        'nationality' => 'Nationaliteit',
        'address' => 'Adres',
        'zip_code'=>'Postcode',
        'city'=>'Stad',
        'country' => 'Land',
        'email' => 'Email',
        'phone' => 'Telefoon',
        'emergency_phone_1' => 'Nood Contact 1',
        'emergency_phone_2' => 'Nood Contact 2',
        'medical_info' => 'Medische Info',
    ];

    /* List of applied filters */
    protected $aFiltersChecked = array(
        'last_name' => 'Familienaam',
        'first_name' => 'Voornaam',
    );

    /**
     * Generates a list of travellers based on the applied filters, current 
     * authenticated user and selected trip.
     *
     * @author Yoeri op't Roodt
     *
     * @param Request $request
     * @param $sUserName
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     */
    public function showFilteredList(Request $request, $iTripId = null) {
        $oUser = Auth::user();
        /* Get all active trips and number of partisipants */
        $aActiveTrips = $this->trips->getAllActive();

        if($aActiveTrips->count() == 0){
            return Redirect::back()->withErrors(['er zijn geen active reizen om weer te geven']); 
        }
        foreach ($aActiveTrips as $oTrip) {
            $aTripsAndNumberOfAttendants[$oTrip->trip_id]['trip_id'] = $oTrip->trip_id;
            $aTripsAndNumberOfAttendants[$oTrip->trip_id]['name'] = $oTrip->name;
            $aTripsAndNumberOfAttendants[$oTrip->trip_id]['year'] = $oTrip->year;
            $aTripsAndNumberOfAttendants[$oTrip->trip_id]['numberOfAttends'] = $this->trips->getNumberOfAttendants($oTrip->trip_id);
        }
     
        /* Get all active trips that can be accessed by the user depending on his role */
        if ($oUser->role == 'admin') {
            $aTripsByOrganiser = $aActiveTrips;
        }elseif ($oUser->role == 'guide') {
            $aTripsByOrganiser = $this->trips->getActiveByOrganiser($oUser->user_id);
            if($aTripsByOrganiser->count() == 0){
                return Redirect::back()->withErrors(['er zijn geen active reizen om weer te geven']); 
            }
        }
        /* if tripId not set set tripId to the first active trip of the organiser */
        if ($iTripId == null) {
            $iTripId = $aTripsByOrganiser[0]->trip_id;
        }
        /* Check if user can access the data of the requested trip */
        if (!$aTripsByOrganiser->contains('trip_id',$iTripId)){
            return abort(403);
        }
      
        /* Get the current trip */
        $oCurrentTrip = $this->trips->get($iTripId);

        /* Detect the applied filters and add to the list of applied filters */
        foreach ($this->aFilterList as $sFilterName => $sFilterText) {
            if ($request->post($sFilterName) != false) {
                $this->aFiltersChecked[$sFilterName] = $sFilterText;
            }
        }
        $aFiltersChecked = $this->aFiltersChecked;
        /* Get the travellers based on the applied filters */
        $aDataToGet = array_add($aFiltersChecked, "username", true); //we always need the unsername
        $aUsers = $this->travellers->getTravellersDataByTrip($iTripId, $aDataToGet);
        /* Check witch download option is checked */
        switch ($request->post('export')) {
            case 'excel':
                $this->downloadExcel($aDataToGet, $aUsers);
                break;
            case 'pdf':
                $this->downloadPDF($aDataToGet, $aUsers, $oTrip);
                break;
        }

        return view('user.lists.tripattendants', [
            'aUsers' => $aUsers,
            'aFilterList' => $this->aFilterList,
            'aFiltersChecked' => $aFiltersChecked,
            'oCurrentTrip' => $oCurrentTrip,
            'aTripsAndNumberOfAttendants' => $aTripsAndNumberOfAttendants,
            'aTripsByOrganiser' => $aTripsByOrganiser,
        ]);
    }
    
    /**
     * @author Sasha Van de Voorde
     * @param $aFiltersChecked
     * @param $aUses
     * @return \Exception|Exception
     * This will download an excel file based on the session data of filters (the checked fields)
     */
    private function downloadExcel($aFiltersChecked, $aUsers) {
        $aUserFields = $aFiltersChecked;
        try {
            /** Create a new Spreadsheet Object **/
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->fromArray($aUserFields, '', 'A1');
            $sheet->fromArray($aUsers, '', 'A2');
            $writer = new Xlsx($spreadsheet);
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment; filename="travellers.xlsx"');
            $writer->save("php://output");
            exit;
        } catch (Exception $e) {
            return $e;
        }
    }

    /**
     * downloadPDF: deze functie zorgt ervoor dat je een pdf van de gefilterde lijst download.
     */
    private function downloadPDF($aFiltersChecked, $aUsers,$oTrip){
        $iCols = count($aUserFields = $aFiltersChecked);
        $aAlphas = range('A', 'Z');
        try {
            $spreadsheet = new Spreadsheet();  /*----Spreadsheet object-----*/
            $spreadsheet->getActiveSheet();
            $activeSheet = $spreadsheet->getActiveSheet();
            if($iCols>8){
                $activeSheet->getPageSetup()->setOrientation(PageSetup::ORIENTATION_LANDSCAPE);
            }
            $activeSheet->fromArray($aUserFields,NULL, 'A1')->getStyle('A1:'.$aAlphas[$iCols-1].'1')->getFont()->setBold(true)->setUnderline(true);
            $activeSheet->getStyle('A1:'.$aAlphas[$iCols-1]."1")->getBorders()->getOutline()->setBorderStyle(1);
            $activeSheet->fromArray($aUsers,NULL,'A2');
            
            foreach ($aUsers as $iRij => $sValue){
                //$activeSheet->getStyle('A'.($iRij+2).':'.$aAlphas[$iCols-1].($iRij+2))->getBorders()->getOutline()->setBorderStyle(1);
                for($iI = 0;$iI<$iCols;$iI++){
                    $activeSheet->getStyle('A'.($iRij+2).':'.$aAlphas[$iI].($iRij+2))->getBorders()->getOutline()->setBorderStyle(1);
                }
            }
            
            IOFactory::registerWriter("PDF", Mpdf::class);
            $writer = IOFactory::createWriter($spreadsheet, 'PDF');
            header('Content-Disposition: attachment; filename="'.$oTrip->name.'_gefilterde_lijst.pdf"');
            $writer->save("php://output");
        } catch (Exception $e) {
            return $e;
        }

    }
    /**
     * @author Stefan Segers
     * @param $iTrpId
     * @param $aUserName
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     * This will show the profile of the selecte Partisipant
     */
    public function showPartisipantsProfile($iTripId, $sUserName) 
    {
        $bIsOrganizer = $this->travellers->isOrganizerForTheTrip($iTripId);
        If ($bIsOrganizer){
            $iUserId = $this->travellers->getIdByUsername($sUserName);
            $aUserData = $this->travellers->get($iUserId);
            return view('user.profile.profile', ['bIsOrganizer' => $bIsOrganizer,'aUserData' => $aUserData]);
        }else{
          return redirect('/');  
        }
    }
    /**
     * Deletes the data of a selected user
     *
     * @author Stefan Segers
     *
     * @param $sUserName
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|string
     */
    public function destroyPartisipantsProfile($iTripId, $sUsername){

        $bIsOrganizer = $this->travellers->isOrganizerForTheTrip($iTripId);
        If ($bIsOrganizer){
            $this->travellers->destroy($sUsername);
            return redirect(route("partisipantslist"))->with('success', 'Je hebt je succesvol het account van '.$sUsername.' verwijdert.');
        }else{
           return Redirect::back()->withErrors(['je hebt geen rechten om dit profiel te wissen']);   
        }
        
        }

    /**
     * @author Stefan Segers
     * @param $iTrpId
     * @param $aUserName
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     * This will edit the profile of the selecte Partisipant
     */
    public function editPartisipantsProfile($iTripId, $sUserName) 
    {
        $bIsOrganizer = $this->travellers->isOrganizerForTheTrip($iTripId);
        If ($bIsOrganizer){
            $iUserId = $this->travellers->getIdByUsername($sUserName);
            $aUserData = $this->travellers->get($iUserId);
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

            return view('user.profile.profileEdit', ['sEditor' => 'organiser','aUserData' => $aUserData, 'aTrips' => $aTripSelectList, 'oZips' => $oZips, 'aStudies' =>  $aStudySelectList, 'aMajors' => $aMajors]);

        }else{
          return Redirect::back()->withErrors(['je hebt geen rechten om dit profiel aan te passen']);  
        }
    }

    /**
     * @author Stefan Segers 
     * @param \App\Http\Controllers\Organiser\ProfileEdit $aRequest
     * @param type $iTripId
     * @param type $sUserName
     * @return redirect
     */
    public function updatePartisipantsProfile(ProfileEdit $aRequest, $iTripId, $sUserName)
    {
        $bIsOrganizer = $this->travellers->isOrganizerForTheTrip($iTripId);
        If ($bIsOrganizer){
            $iUserId = $this->travellers->getIdByUsername($sUserName);

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
            $this->travellers->update($aProfileData,$iUserId);
            //if trip changed update trip (not possible for an organizer)
            if($iTripId != $aRequest->post('Trip')){
                if( Auth::user()->user_id != $iUserId){
                    $this->travellers->changeTrip($iUserId, $iTripId, $aRequest->post('Trip'));
                }else{
                    return Redirect::back()->withErrors(['je kan je geen organisator maken van een andere reis dan die je is toegekend']);
                }
            }
            return redirect('/organiser/showpartisipant/'.$iTripId.'/'.$sUserName);
        }else{
            return Redirect::back()->withErrors(['je hebt geen rechten om dit profiel aan te passen']); ;  
        }
    }
}
