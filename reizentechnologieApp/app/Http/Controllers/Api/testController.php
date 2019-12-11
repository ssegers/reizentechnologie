<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Trip;

class testController extends Controller
{
    public function test() {
        $t = Trip::find(1);
        $d = $t->days()->first();
        $p = $d->plannings()->skip(1)->first();

        return $p->activity()->first();
    }
}
