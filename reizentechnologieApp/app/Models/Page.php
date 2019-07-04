<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Page Model
 */
class Page extends Model
{
    //
    protected $primaryKey = 'page_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'content', 'is_visible', 'type'
    ];
    
    public static function getHomePage()
    {
        $homePage = Page::where('name', 'Home')->first();
        return $homePage;   
    }
    
    public static function getPage($pageName)
    {
        try {
            $page = Page::where('name', $pageName)->firstOrFail();
            return $page;
        }catch (ModelNotFoundException $ex) {
            return "Sorry but this link has no content";
        }
    }
    
    public static function visibleMenuItems()
    {
        $visibleMenuItems = Page::where('name','!=','Home')->where('is_visible',true)->get(['name']);
        return $visibleMenuItems->toArray();
    }
}
