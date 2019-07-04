<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Contracts\PageRepository;

class InfoPagesController extends Controller
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
     * This function shows the pagesOverview view
     *
     * @author Michiel Guilliams
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        $aPages = $this->pages->getAllInfoPages();
        return view('admin.infoPages.pagesOverview', array(
            'aPages' => $aPages,
        ));
    }

    /**
     * This function creates a new page and shows the editPage view of the new page
     *
     * @author Michiel Guilliams
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createPage(Request $request){
        $sPageName=$request->input('Name');
        //opmerking nog testen of de naam van de pagina verschilt van Home
        $this->pages->create($sPageName);
        $oPage = $this->pages->get($sPageName);

        return view('admin.infoPages.editPage', array(
            'oPage' => $oPage,
        ))->with('message', 'De pagina is aangemaakt');
    }    
    
    /**
     * This function shows the editPage view
     *
     * @author Michiel Guilliams
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editPage(Request $request){
        $sPageName = $request->input('name');
        $oPage = $this->pages->get($sPageName);
        return view('admin.infoPages.editPage', array(
            'oPage' => $oPage,
        ));
    }



    /**
     * This function deletes the related view
     *
     * @author Michiel Guilliams
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deletePage(Request $request){

        $pageId = $request->input('pageId');
        $bSuccess = $this->pages->delete($pageId);
        if ($bSuccess){
            return redirect()->back()->with('message', 'De pagina is verwijderd');
        }else{
            return redirect()->back()->with('message', 'De pagina kan niet worden verwijderd');
        }
    }

    /**
     * This function updates a page
     *
     * @author Michiel Guilliams
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateContent(Request $request){
        $iPageId = $request->input('pageId');
        $aPageData['type'] = $request->get('typeSelector');
        if($aPageData['type'] == 'pdf') {            
            $aPageData['content'] = ($request->input("filepath") == null) ? "" : $request->input("filepath");
            $aPageData['is_visible'] = (bool)$request->input("Visible");
            $this->pages->update($aPageData,$iPageId);
            return redirect()->route("infoPages")->with('message', 'De pagina is aangepast');
        }
        else{
            $aPageData['content'] = (strlen($request->get('content')) == 0) ? "" : $request->get('content');
            $aPageData['is_visible'] = (bool)$request->input("Visible");
            $this->pages->update($aPageData,$iPageId);
            return redirect()->route("infoPages")->with('message', 'De pagina is aangepast');
        }

    }

    /**
     * This function shows a page in the front-end
     *
     * @author Michiel Guilliams
     *
     * @param $page_name
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function showPage($page_name){
        $aPages= Page::where('type','!=','info')->where('name',$page_name)->first();
        if($aPages!=null) {
            return view('guest.contentpage', array(
                'aPages' => $aPages,
            ));
        }
        else{
            return "pagina bestaat niet";
        }
    }
}
