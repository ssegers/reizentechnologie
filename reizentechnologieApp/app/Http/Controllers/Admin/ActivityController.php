<?php

namespace App\Http\Controllers\Admin;
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


    public function showAllActivities()
    {
        $activities = $this->activities->getActivities();
        return view('admin.activitytest', ['activities' => $activities]);
    }

    public function UpdateOrCreateTrip(ActivityForm $request)
    {
        $iActivityId = $request->post('activity-id');
        $aData['name'] = $request->input('activity-name');
        $aData['start_hour'] = $request->input('activity-start_hour');
        $aData['end_hour'] = $request->input('activity-end_hour');
        $aData['description'] = $request->input('activity-description');
        $aData['location'] = $request->post('activity-location');
        if($iActivityId == -1){
            $this->activities->addActivity($aData);
            return redirect('/admin/activitytest')->with('message', 'De activity is succesvol opgeslagen');
        }
        else{
            $this->activities->updateActivity($aData, $iActivityId);
            return redirect('/admin/activitytest')->with('message', 'De reisgegevens zijn aangepast');
        }
    }
}
