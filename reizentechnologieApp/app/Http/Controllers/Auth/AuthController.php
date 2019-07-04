<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Repositories\Contracts\UserRepository;

class AuthController extends controller
{
    /**
     *
     * @var UserRepository
     */
    private $users;

    public function __construct(UserRepository $user) 
    {
       $this->users = $user;
    }
    
    public function index()
    {
        return view('home');
    }
    
    public function showView()
    {
        if (Auth::check()){
            return (route("home"));
        }
        else{
            return view("auth.Authenticate");
        }
    }
    
    public function login(Request $request)
    {
        try
        {
            $user = $this->users->get(request('username'));//   User::where(['username'=> request('username'), 'password' => request('password')])->get();
            if (! auth()->attempt(request(['username', 'password'])))
            {
                if (! auth()->loginUsingId($user->user_id))
                {
                    return back()->with('message', 'Gebruikersnaam of passwoord is fout.');
                }
            }
            if (Auth::user()) {
                $role = Auth::user()->role;
                if ($role == "admin"){
                    
                    return redirect('/admin/dashboard');
                }
                if ($role == "guest"){
 
                    return redirect('/user/registrationform/step-0');
                }
                return redirect('/');
            }
        }
        catch (\Exception $e) {

            return back()->with('message', 'Gebruikersnaam of passwoord is fout '. $e->getMessage());
        }
    }
    
    public function logout(Request $request)
    {
        $request->session()->flush();
        Auth::logout();
        return redirect('/');
    }
}