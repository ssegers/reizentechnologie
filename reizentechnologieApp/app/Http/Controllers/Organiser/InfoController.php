<?php

namespace App\Http\Controllers\Organiser;
use App\Http\Controllers\Controller;

use App\Repositories\Contracts\InfoRepository;

        
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;


class InfoController extends Controller
{
    /**
     *
     * @var PageRepository
     */
    private $info;        
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(InfoRepository $info)
    {
        $this->info = $info;
    }


    /**
     * This function fills the editor with its saved content
     *
     * @author Michiel Guilliams
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getInfo(){
        $oInfo = $this->info->get('algemene_info');
        //return view('organizer.info', ['test' => $oInfo]);

        return view('organizer.info', array(
            'oInfo' => $oInfo,
        ));
    }

    /**
     * This function updates the content of the infoPage
     *
     * @author Michiel Guilliams
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateInfo(Request $request){
        $sInfoContent = $request->post('info_value');
        if (strlen($sInfoContent) == 0){
            $sInfoContent = "";
        }
        $this->info->updateInfoPage($sInfoContent);
        return redirect()->back()->with('message', 'De info pagina is aangepast');
    }
}
