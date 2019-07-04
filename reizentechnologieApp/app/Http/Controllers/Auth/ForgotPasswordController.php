<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

use App\Repositories\Contracts\TravellerRepository;
use App\Repositories\Contracts\UserRepository;

//use App\Models\User;
use App\Mail\ResetPas;



class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    /**
     *
     * @var TravellerRepository
     */    
    private $travellers;
    /**
     *
     * @var UserRepository
     */    
    private $users;    
    /**
     * ForgotPasswordController Constructor
     * 
     * @param travellerRepository $traveller
     */
    public function __construct(TravellerRepository $traveller, UserRepository $user) 
    {
       $this->travellers = $traveller;
       $this->users = $user;
    }
    
    public function ShowEnterEmailForm()
    {
        if (Auth::check()){
            return redirect(route('/'));
        }
        else{
            return view('auth.passwords.enterEmail');
        }
    }
    
    public function EnterEmailFormPost(Request $request){
        $email = $request->input('email');

        Try {

            $oTraveller = $this->travellers->getByEmail($email);

            if ($oTraveller == ""){
                return back()->with('message', 'Geen gebruiker gevonden met dit emailadres.');
            }
            $userId = $oTraveller->user_id;
            $name = $oTraveller->first_name;
            $surname = $oTraveller->last_name;
            $fullname = $name . " " . $surname;
            $year = Carbon::now()->year;
            $month = Carbon::now()->month;
            if ($month < 10){
                $month = '0'. $month;
            }
            $day = Carbon::now()->day;
            if ($day < 10){
                $day = '0'. $day;
            }
            $hour = (string)Carbon::now()->hour;
            if ($hour < 10){
                $hour = '0'. $hour;
            }
            $minute = Carbon::now()->minute;
            if ($minute < 10){
                $minute = '0'. $minute;
            }
            $aUserData['resettoken'] = $year.$month.$day.$hour.$minute.Str::random().'*'.$userId;
           
            $this->users->update($aUserData, $userId);
            //$token = $year.$month.$day.$hour.$minute.Str::random().'*'.$travellerid;
            //User::where('user_id',$travellerid)->update(['resettoken' => $token]);
            $aMailData = [
                'subject' => 'Password reset',
                'fullname' => $fullname,
                'email' => $email,
                'token' =>  $aUserData['resettoken']
            ];
            Mail::to($email)->send(new ResetPas($aMailData));
            return redirect()->route("log")->with('message', 'De Mail met de paswoord reset instructie is verstuurd.');
            }
        catch (\Exception $e ){
            return redirect()->route("log")->with('errormessage', 'Er is een fout opgetreden met het versturen van de mail, gebruik het contactformulier om dit te melden.');
        }
    }
}
