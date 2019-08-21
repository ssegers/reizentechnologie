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
       
    public static function visibleMenuItems()
    {
        $visibleMenuItems = Page::where('name','!=','Home')->where('is_visible',true)->get(['name']);
        return $visibleMenuItems->toArray();
    }
}
