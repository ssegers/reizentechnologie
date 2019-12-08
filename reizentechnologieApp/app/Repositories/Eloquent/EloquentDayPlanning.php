<?php

namespace App\Repositories\Eloquent;
use App\Repositories\Contracts\DayPlanningRepository;
use App\Models\DayPlanning;

class EloquentDayPlanning implements DayPlanningRepository
{
    private $model;
    
    public function __construct(DayPlanning $model) {
        $this->model = $model;
    }

    public function getDayPlannings() {
        
    }
}