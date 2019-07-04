<?php
namespace App\Repositories\Contracts;

/**
 * Description of PageRepository
 *
 * @author u0067341
 */
interface PageRepository 
{
    public function create($sPageName);
    public function get($sPageName);
    public function update($aPageData,$iPageId);
    public function delete($iPageId);
    public function updateHomePage($sPageContent);
    public function getAllInfoPages();
}
