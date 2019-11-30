<?php

namespace App\Repositories\Eloquent;
use App\Repositories\Contracts\InfoRepository;
use App\Models\Information;

class EloquentInfo implements InfoRepository
{
    private $model;
    
    public function __construct(Information $model) {
        $this->model = $model;
    }

    public function getAlgemeneInfo() {
        return \Illuminate\Support\Facades\DB::table('information')->select("id", "info_value")->where(["info_name" => "algemene_info"])->first();
    }
}