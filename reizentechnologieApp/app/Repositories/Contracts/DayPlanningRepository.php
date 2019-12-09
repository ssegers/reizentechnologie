<?php

namespace App\Repositories\Contracts;

interface DayPlanningRepository
{
    public function getDayPlanningsPerTrip($iTripId);
    public function addDayPlanningToTrip($aData);
    public function updateDayPlanning($data);
    public function deleteDayPlanningFromTrip($iId);
    public function storeDayPlanning($request);
}