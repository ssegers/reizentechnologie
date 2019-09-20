<?php
namespace App\Repositories\Contracts;

/**
 * Description of PageRepository
 *
 * @author u0067341
 */
interface PaymentRepository 
{
    public function getByTrip($iTripId);
}