<?php

namespace App\Repositories\Eloquent;
use App\Repositories\Contracts\DayPlanningRepository;
use Illuminate\Support\Facades\DB;
use App\Models\DayPlanning;
use App\Models\Trip;

class EloquentDayPlanning implements DayPlanningRepository
{
    private $model;
    
    public function __construct(DayPlanning $model) {
        $this->model = $model;
    }

    public function getDayPlanningsPerTrip($iTripId){
        $dayplannings = Trip::where('trip_id',$iTripId)->first()->dayplannings()->orderBy('date','asc')->get();
        return $dayplannings; 
    }

    public function addDayPlanningToTrip($aData){
        $trip = Trip::find($aData['trip_id']);
        $trip->dayplannings()->attach($aData['dayplanning_id'],['date' => $aData['date'], 'highlight' => $aData['highlight'], 'description' => $aData['description'], 'location' =>$aData['location']]);
        return true;
    }

    public function updateDayPlanning($data){
        $dayplanning = DayPlanning::find($request->DayPlanningId);
        $dayplanning->date = $request->Date;
        $dayplanning->highlight = $request->Highlight;
        $dayplanning->description = $request->Description;
        $dayplanning->location = $request->Location;
        $dayplanning->save();
        return true;
    }

    public function deleteDayPlanningFromTrip($iId){
        $sqlDelete = "delete from dayplanning where id=$iId";
        DB::select($sqlDelete);

        return true;
    }

    public function storeDayPlanning($request){
        /*$dayplanning = new DayPlanning();
        $dayplanning->date = $request->Date;
        $dayplanning->highlight = $request->Highlight;
        $dayplanning->description = $request->Description;
        $dayplanning->location = $request->Location;
        $dayplanning->save();
        return true;*/
    }
}