<?php

namespace App\Repositories\Eloquent;
use App\Repositories\Contracts\StudieRepository;

use App\Models\Study;
use App\Models\Major;

/**
 * accessing city data
 *
 * @author u0067341
 */
class EloquentStudie implements StudieRepository
{
    /**
     * 
     * @return type
     */
    public function get()
    {    
        return Study::select('study_id','study_name')->get();

    }
    /**
     * 
     * @param type $studyId
     * @return type
     */
    public function getMajorsByStudy($studyId)
    {    
        $aMajors = Major::GetMajorsByStudy($studyId)->pluck('major_name', 'major_id');
        return $aMajors;
    }
}