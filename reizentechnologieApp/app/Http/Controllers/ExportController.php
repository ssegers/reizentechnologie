<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PaymentsExport;
use App\Repositories\Contracts\PaymentRepository;

class ExportController extends Controller
{
 protected $payments;
 public function __construct(PaymentRepository $payments) 
    {
       $this->payments = $payments;
    }    

function paymentsExport($iTripId)
{
    $paymentDataToExport = $this->payments->getByTrip($iTripId);
    if ($paymentDataToExport != False){
        return Excel::download(new PaymentsExport($paymentDataToExport),'payments.xlsx');
    }else{
        return back()->with('errormessage', 'Er zijn geen betalingsgegevens om te exporteren');
    }
}

}