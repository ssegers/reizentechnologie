<?php

namespace App\Repositories\Eloquent;
use App\Http\Requests\ActivityForm;
use App\Repositories\Contracts\ActivityRepository;
use Illuminate\Support\Facades\DB;

use App\Models\Activities;
use App\Models\Planning;

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

    public function getPlannings() {
        $plannings = Planning::all();
        return $plannings;
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
            $oActivity->name = $data['name'];
            $oActivity->description = $data['description'];
            $oActivity->location = $data['location'];
            $oActivity->save();

            $planning = new Planning();
            $planning->activity_id = $oActivity->activity_id;
            $planning->day_id = $data['day_id'];
            $planning->start_hour = $data['start_hour'];
            $planning->end_hour = $data['end_hour'];
            $planning->save();
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
            $oActivity = Activities::find($iActivityId);
            $oActivity->name = $data['name'];
            //$oActivity->start_hour = $data['start_hour'];
            //$oActivity->end_hour = $data['end_hour'];
            $oActivity->description = $data['description'];
            $oActivity->location = $data['location'];
            $oActivity->save();

            Planning::where('activity_id', $iActivityId)->update(array('start_hour' => $data['start_hour'], 'end_hour' => $data['end_hour']));
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

    public function getActivitiesInDay($dayId){
        $activities = Planning::where('day_id', $dayId)->get();
        return $activities;
    }

    public function saveOrDeleteActivities($dayId, $activityIds, $aHours)
    {
        if($activityIds != -1) {
            for ($i = 0; $i < strlen($activityIds); $i++) {

                Planning::where(['activity_id' => $activityIds[$i], 'day_id' => $dayId])->delete();
                $activityInPlanning = new Planning();
                $activityInPlanning->activity_id = $activityIds[$i];
                $activityInPlanning->day_id = $dayId;
                $activityInPlanning->start_hour = $aHours['start_hour'];
                $activityInPlanning->end_hour = $aHours['end_hour'];
                $activityInPlanning->save();
            }
        }else{
            Planning::where('day_id', $dayId)->delete();
        }

    }
}
