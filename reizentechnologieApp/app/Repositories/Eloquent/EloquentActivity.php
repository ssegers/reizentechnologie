<?php

namespace App\Repositories\Eloquent;
use App\Repositories\Contracts\ActivityRepository;
use Illuminate\Support\Facades\DB;

use App\Models\Activities;

/**
 *
 *
 * @author u0067341
 */
class EloquentActivity implements ActivityRepository
{

    /**
     * get all activities
     *
     * @return collection
     */
    public function getActivities() {
        $activities = Activities::all();
        return $activities;
    }


    /**
     * add activity
     *
     * @return
     */
    public function addActivity($data)
    {
        /* Create the activity */
        try{
            $oActivity = new Activities();
            $oActivity->day_planning_id = $data['day_planning_id'];
            $oActivity->name = $data['name'];
            $oActivity->start_hour = $data['start_hour'];
            $oActivity->end_hour = $data['end_hour'];
            $oActivity->description = $data['description'];
            $oActivity->location = $data['location'];
            $oActivity->save();
        }
        catch(\Exception $e)
        {
            throw $e;
        }
    }


    /**
     * update activity
     *
     * @return
     */
    public function updateActivity($data, $iActivityId)
    {
        /* Update the activity */
        try{
            $oActivity = Trip::find($iActivityId);
            $oActivity->day_planning_id = $data['day_planning_id'];
            $oActivity->name = $data['name'];
            $oActivity->start_hour = $data['start_hour'];
            $oActivity->end_hour = $data['end_hour'];
            $oActivity->description = $data['description'];
            $oActivity->location = $data['location'];
            $oActivity->save();
        }
        catch(\Exception $e)
        {
            throw $e;
        }
    }

    /**
     * delete activity
     *
     * @return
     */
    public function deleteActivity($id)
    {
        Activities::where('activity_id', $id)->delete();
    }
}
