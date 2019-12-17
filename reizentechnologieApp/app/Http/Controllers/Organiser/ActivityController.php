<?php

namespace App\Http\Controllers\Organiser;
use App\Http\Controllers\Controller;
use App\Http\Requests\ActivityForm;
use App\Repositories\Contracts\ActivityRepository;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    /**
     *
     * @var ActivityRepository
     */
    private $activities;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ActivityRepository $activity)
    {
        $this->activities = $activity;
    }


    public function showAllActivities($dayId)
    {
        $activities = $this->activities->getActivities();
        $plannings = $this->activities->getPlannings();
        $activitiesInDay = $this->activities->getActivitiesInDay($dayId);

        return view('organizer.activities', ['activities' => $activities, 'plannings' => $plannings, 'dayActivities' => $activitiesInDay]);
    }

    public function createActivity(ActivityForm $request)
    {
        $iActivityId = $request->post('activity-id');
        $aData['name'] = $request->input('activity-name');
        $aData['start_hour'] = $request->input('activity-start');
        $aData['end_hour'] = $request->input('activity-end');
        $aData['description'] = $request->input('activity-description');
        $aData['location'] = $request->post('activity-location');
        $aData['day_id'] = $request->post('day-id');

        $this->activities->addActivity($aData);
        return redirect()->back()->with('message', 'De activiteit is succesvol opgeslagen');

    }

    public function updateActivity(ActivityForm $request)
    {
        $iActivityId = $request->post('activity-id');
        $aData['name'] = $request->input('activity-name');
        $aData['start_hour'] = $request->input('activity-start');
        $aData['end_hour'] = $request->input('activity-end');
        $aData['description'] = $request->input('activity-description');
        $aData['location'] = $request->post('activity-location');

        $this->activities->updateActivity($aData, $iActivityId);
        return redirect()->back()->with('message', 'De activiteit is aangepast');

    }

    public function deleteActivity($id){
        $this->activities->deleteActivity($id);
        return redirect()->back()->with('message', 'Je hebt succesvol de activiteit verwijdert.');
    }

    public function saveActivities($dayId, $activityIds, ActivityForm $request){
        $aHours['start_hour'] = $request->input('activity-start');
        $aHours['end_hour'] = $request->input('activity-end');


        if ($activityIds != 0) {
            $activityIds = str_replace(',', '', $activityIds);
            $activityIds = count_chars($activityIds, 3);
            $this->activities->saveOrDeleteActivities($dayId, $activityIds, $aHours);

            return redirect()->back()->with('message', 'Je hebt succesvol de activiteiten aan de dag gelinkt.');
        } else{
            $this->activities->saveOrDeleteActivities($dayId, -1, $aHours);

            return redirect()->back()->with('message', 'Je hebt succesvol de activiteiten aan de dag gelinkt.');
        }
    }
}
