<?php

namespace App\Repositories\Eloquent;
use App\Repositories\Contracts\InfoRepository;
use App\Models\Information;

class EloquentInfo implements InfoRepository
{
 public function get($sInfoName)
    {
        try {
            $info = Information::where('info_name', $sInfoName)->firstOrFail();
            return $info;
        }catch (ModelNotFoundException $ex) {
            return "Sorry but this link has no content";
        }
    }

    public function updateInfoPage($sInfoContent) 
    {
        Information::where('info_name', 'algemene_info')->update(['info_value' => $sInfoContent]);
    }
}