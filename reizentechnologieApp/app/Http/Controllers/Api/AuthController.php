<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Contracts\TravellerRepository;

class AuthController extends Controller
{
    private $travellerRepository;

    public function __construct(TravellerRepository $travellerRepository) {
        $this->travellerRepository = $travellerRepository;
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->only('username', 'password');
        if(Auth::attempt($credentials)) {
            return Array(
                "status" => "succedded",
                "api_token" => Auth::user()->api_token,
                "first_name" => $this->travellerRepository->getFirstNameByUserId(Auth::id()),
                "last_name" => $this->travellerRepository->getLastNameByUserId(Auth::id()),
                "traveller_id" => $this->travellerRepository->getTravellerIdByUserId(Auth::id()),
            );
        }
        return Array(
            "status" => "failed",
            "message" => "username or password wrong"
        );
    }
}
