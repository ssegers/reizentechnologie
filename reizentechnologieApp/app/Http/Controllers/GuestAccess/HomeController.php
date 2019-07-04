<?php

namespace App\Http\Controllers\GuestAccess;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Repositories\Contracts\PageRepository;

class HomeController extends Controller
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
     * This function shows the home page in the front-end
     *
     * @author Stefan Segers
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function home(){

        //$page = PageModel::getHomePage();
        $page = $this->pages->get('home');
        return view('guest.home', array(
            'page' => $page
        ));
    }
    
    /**
     * This function shows a page in the front-end
     *
     * @author Stefan Segers
     *
     * @param $pageName
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function showPage($pageName)
    {
        $page = $this->pages->get($pageName);
        return view('guest.contentpage', array(
                'page' => $page
            ));
    }
}
