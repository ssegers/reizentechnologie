<?php

namespace App\Repositories\Eloquent;
use App\Repositories\Contracts\PageRepository;

Use App\Models\Page;

/**
 * accessing Page data
 *
 * @author u0067341
 */
class EloquentPage implements PageRepository
{
    /**
     * get page with name
     * @param type $sPageName
     */
    public function get($sPageName)
    {
        try {
            $page = Page::where('name', $sPageName)->firstOrFail();
            return $page;
        }catch (ModelNotFoundException $ex) {
            return "Sorry but this link has no content";
        }
    }

    public function updateHomePage($sPageContent) 
    {
        Page::where('name', 'Home')->update(['content' => $sPageContent]);
    }

    public function getAllInfoPages() 
    {

        return Page::where('name','!=','Home')->get();

    }

    public function create($sPageName) 
    {
        $oPage = new Page;
        Page::insert([
           'name'=>$sPageName,
           'content'=>'',
           'is_visible'=>false,
           'type'=>'pdf'
        ]);
    }

    public function update($aPageData,$iPageId){
        Page::where('page_id', $iPageId)->update($aPageData);
    }
    
    public function delete($iPageId) {
        
        $oPage = Page::where('page_id',$iPageId)->first();
        if ($oPage->name != "Home"){
            $oPage->delete();
            return true;
        }else{
            return false;
        }
    }
            
}
