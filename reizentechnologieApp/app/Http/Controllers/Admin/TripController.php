<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\TripRepository;
use App\Http\Requests\TripForm;
use Illuminate\Http\Request;

class TripController extends Controller
{
    /**
     *
     * @var TripRepository
     */
    private $trips;
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(TripRepository $trip)
    {
        $this->trips = $trip;
    }
    

    /**
     * get all trips
     * 
     * @author Stefan Segers
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showAllTrips()
    {
        //$aTrips = DB::table('trips')->orderBy('year')->get();
        $trips = $this->trips->getAllTrips();
        return view('admin.trips.show', ['trips' => $trips]);
    }


    public function UpdateOrCreateTrip(TripForm $request)
    {
        $iTripId = $request->post('trip-id');
        $aData['name'] = $request->input('trip-name');
        $aData['is_active'] = $request->input('trip-is-active', false);
        $aData['year'] = $request->input('trip-year');
        $aData['contact_mail'] = $request->input('trip-mail');
        $aData['price'] = $request->post('trip-price');
        if($iTripId == -1){
            $this->trips->store($aData);
            return redirect('/admin/trips')->with('message', 'De reis is succesvol opgeslagen');
        }
        else{
            $this->trips->update($aData, $iTripId);
            return redirect('/admin/trips')->with('message', 'De reisgegevens zijn aangepast');
        }
    }
}