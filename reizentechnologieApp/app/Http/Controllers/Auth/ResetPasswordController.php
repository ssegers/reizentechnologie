<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use App\Repositories\Contracts\UserRepository;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */
    
    /**
     *
     * @var UserRepository
     */    
    private $users;  
    
    /**
     * ResetPasswordController Constructor
     * 
     * @param userRepository $user
     */
    public function __construct(UserRepository $user) 
    {
       $this->users = $user;
    }
    private function IsTokenStillValid($tokenUser, $GivenToken){
        if($tokenUser == $GivenToken){
            $year = substr($GivenToken,0,4);
            $month = substr($GivenToken,4,2);
            $day = substr($GivenToken,6,2);
            $hour = substr($GivenToken,8,2);
            $minute = substr($GivenToken,10,2);
            $TokenTime = Carbon::create($year,$month,$day,$hour,$minute);        
            if (Carbon::now()->diffInMinutes($TokenTime) < 30){
                return true;
            }
            else{
                return false;
            }
        }
        else{
            return false;
        }
    }

    public function ShowResetPasswordForm($token)
    {
        Try {
            $userid = explode("*", $token)[1];
            $userToken = $this->users->getResetToken($userid);
            if ($this->IsTokenStillValid($userToken,$token)){
                if (Auth::check()){
                    return redirect(\route('home'));
                }
                else{
                    return view("auth.passwords.resetpassword", ["userid"=>$userid,"fulltoken"=>$token]);
                }
            }
            else{
                return redirect()->route("home")->with('errormessage', 'De mail voor het resetten van het paswoord is vervallen. Doe een nieuwe aanvraag.');
            }
        }catch (\ErrorException $e){
            return redirect()->route("home")->with('errormessage', 'je bent geen geldige gebruiker van de site. Gebruik het contactformulier om contact op te nemen.');
        }
    }
    
    public function ResetPassword(Request $request)
    {
        try{
            $p1 = $request->input('password1');
            $p2 = $request->input('password2');
            $userid = $request->input('userid');
            $GivenToken = $request->input("fulltoken");
            $userToken = $this->users->getResetToken($userid);
           
            if($this->IsTokenStillValid($userToken,$GivenToken)){
                if ($p1 == $p2){
                    if (strlen($p1) >= 8){
                        $aData['password'] = bcrypt($p1);
                        $this->users->update($aData, $userid);
                        return redirect()->route("log")->with('message', 'Paswoord is aangepast.');
                    }
                    else{
                        return back()->with('message', 'Het paswoord moet minstens 8 tekens lang zijn.');
                    }
                }
                else{
                    return back()->with('message', 'Paswoorden komen niet met elkaar overeen.');
                }
            }
            else {
                return redirect()->route("home")->with('errormessage', 'De tijd om je paswoord opnieuw in te stellen is vervallen, doe een nieuwe aanvraag.');
            }
        }catch(\ErrorException $e){
            return redirect()->route("home")->with('errormessage', 'Je paswoord kon niet worden ingesteld. Gebruik het contactformulier om contact op te nemen.');
        }
    }    
}
