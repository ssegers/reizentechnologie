<?php

namespace App\Repositories\Eloquent;
use App\Repositories\Contracts\DayPlanningRepository;
use Illuminate\Support\Facades\DB;
use App\Models\Day;
use App\Models\Trip;

class EloquentDayPlanning implements DayPlanningRepository
{
    private $model;
    
    public function __construct(Day $model) {
        $this->model = $model;
    }

    public function getDayPlannings(){
        return \Illuminate\Support\Facades\DB::table('days')->select("id", "highlight")->first();
    }

    public function getDayPlanningsPerTrip($iTripId){
        $dayplannings = Trip::where('trip_id',$iTripId)->first()->days()->orderBy('date','asc')->get();
        return $dayplannings; 
    }

    public function addDayPlanningToTrip($aData){
        $trip = Trip::find($aData['trip_id']);
        $trip->days()->attach($aData['day_id'],['date' => $aData['date'], 'highlight' => $aData['highlight'], 'description' => $aData['description'], 'location' =>$aData['location']]);
        return true;
    }

    public function updateDayPlanning($request){
        dd($request);
        $dayplanning = Day::find($request->Day_id);
        dd($dayplanning);
        //$dayplanning->day_id = $request->Day_id;
        $dayplanning->date = $request->Date;
        $dayplanning->highlight = $request->Highlight;
        $dayplanning->description = $request->Description;
        $dayplanning->location = $request->Location;
        $dayplanning->save();
        return true;
    }

    public function deleteDayPlanningFromTrip($iId){
        $sqlDelete = "delete from days where id=$iId";
        DB::select($sqlDelete);

        return true;
    }

    public function storeDayPlanning($request){
        $dayplanning = new Day();
        $dayplanning->date = $request->Date;
        $dayplanning->highlight = $request->Highlight;
        $dayplanning->description = $request->Description;
        $dayplanning->location = $request->Location;
        $dayplanning->trip_id = $request->Trip_id;
        $dayplanning->save();
        return true;
    }
}