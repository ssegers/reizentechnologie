<?php

namespace App\Http\Controllers\Organiser;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use App\Repositories\Contracts\DayPlanningRepository;

class DayPlanningController extends Controller
{
    private $dayplanning;
    
    public function __construct(DayPlanningRepository $dayplanning) {
        $this->dayplanning = $dayplanning;
    }
    
    public function CheckDbConnection(){
        try {
            DB::connection()->getPdo();
        } catch (\Exception $e) {
            return  true ;  
        }
    }
    
    public function index() {
        if($this->CheckDbConnection()){
            return redirect()->route('home')->withErrors(["DB connectie mislukt" => "Kan niet met de database connecteren."]);
        }
        else{
            $dayplanning_content = $this->dayplanning->getDayPlannings();

            return view('organizer.dayplanning', ['idayplanning_content' => $dayplanning_content->highlight]);
        }
    }
}