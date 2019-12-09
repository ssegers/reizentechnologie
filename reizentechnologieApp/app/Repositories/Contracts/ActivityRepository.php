<?php
namespace App\Repositories\Contracts;

/**
 * Description of ActivityRepository
 *
 * @author u0067341
 */
interface ActivityRepository {

    /**
     * get all activities
     *
     * @return
     */
    public function getActivities();

    /**
     * add activity
     *
     * @return
     */
    public function addActivity($data);

    /**
     * update activity
     *
     * @return
     */
    public function updateActivity($data, $iActivityId);

    /**
     * delete activity
     *
     * @return
     */
    public function deleteActivity($id);
}
