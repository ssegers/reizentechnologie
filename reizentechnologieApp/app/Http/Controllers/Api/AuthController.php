<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function authenticate(Request $request)
    {
        //dd($request);
        $credentials = $request->only('username', 'password');
        if(Auth::attempt($credentials)) {
            return Array(
                "status" => "succedded",
                "api_token" => Auth::user()->api_token
            );
        }
        return Array(
            "status" => "failed",
            "message" => "username or password wrong"
        );
    }
}
