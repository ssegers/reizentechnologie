<?php
namespace App\Repositories\Contracts;

/**
 * Description of StudieRepository
 *
 * @author u0067341
 */
interface StudieRepository 
{
    /**
     * 
     * 
     * @return type
     */
    public function get();
    /**
     * 
     * @param type $studyId
     * @return type
     */
    public function getMajorsByStudy($studyId);
    
}
