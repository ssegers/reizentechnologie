<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Room;

class testController extends Controller
{
    public function test() {
        $h = Room::find(1);
        //dd($h);
        return $h->travellers()->get();
    }
}
