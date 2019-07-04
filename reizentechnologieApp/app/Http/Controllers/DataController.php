<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\Contracts\StudieRepository;

class DataController extends Controller
{
    function __construct(StudieRepository $studie) {
        $this->middleware('auth');
        $this->middleware('checkloggedin');

        $this->studies = $studie;
    }
    
    /**
     * 
     * @param type $studyId
     * @return type
     */
    public function getMajorsByStudy($studyId)
    {    
        $aMajors = $this->studies->getMajorsByStudy($studyId);
        return json_encode($aMajors);
    }
}
