<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Repositories\Contracts\PageRepository;
        
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;


class HomePageController extends Controller
{
    /**
     *
     * @var PageRepository
     */
    private $pages;        
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(PageRepository $page)
    {
        $this->pages = $page;
    }


    /**
     * This function fills the editor with its saved content
     *
     * @author Michiel Guilliams
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getInfo(){
        $oPage = $this->pages->get('home');
       
        return view('admin.home.editHomePage', array(
            'oPage' => $oPage,
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
        $sPageContent = $request->post('content');
        if (strlen($sPageContent) == 0){
            $sPageContent = "";
        }
        $this->pages->updateHomePage($sPageContent);
        return redirect()->back()->with('message', 'De info pagina is aangepast');
    }

    /**
     * This function shows the infoPage in the front-end
     *
     * @author Michiel Guilliams
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showInfo(){
        $oContent=Page::where('name', 'Info')->first();
        return view('guest.infopage', array(
            'oContent' => $oContent,
        ));
    }
}
