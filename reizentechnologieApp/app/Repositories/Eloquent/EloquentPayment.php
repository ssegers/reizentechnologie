<?php

namespace App\Repositories\Eloquent;
use App\Repositories\Contracts\PaymentRepository;
use Illuminate\Database\Eloquent\Collection;
Use App\Models\Payment;
use App\Models\Traveller;

/**
 * accessing Page data
 *
 * @author u0067341
 */
class EloquentPayment implements PaymentRepository
{
    
    public function getByTrip($iTripId) 
    {
        //get payments per trip and related traveller and user data
        $payments = Payment::with(['traveller:traveller_id,user_id,first_name,last_name','traveller.user:user_id,username' ])
                ->where('trip_id',$iTripId)
                ->select('payment_id','traveller_id','date_of_payment','amount')
                ->get();

        if ($payments->isNotEmpty()){
            //make collection of collections with the necessary attributes
            $paymentData = new Collection;
            foreach($payments as $payment){
                $paymentData->put($payment->payment_id, collect([
                    'username' => $payment->traveller->user->username,
                    'firstname' => $payment->traveller->first_name,
                    'lastname' => $payment->traveller->last_name,
                    'date' => $payment->date_of_payment,
                    'amount' =>$payment->amount]));
            }   
            return $paymentData->sortBy('lastname'); 
        }
        else{
            return false;
        }
    }

}
