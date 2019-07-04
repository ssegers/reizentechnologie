<?php
namespace App\Repositories\Contracts;

/**
 * Description of CityRepository
 *
 * @author u0067341
 */
interface CityRepository 
{
    public function store($aData); 
    
    public function get();
}
