<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PaymentsExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    
    protected $paymentData;
    /**
     * PaymentsExport Constructor
     * 
     * @param travellerRepository $traveller
     * @param tripRepository $trip
     */
    public function __construct($paymentData) 
    {
       $this->paymentData = $paymentData;
    }    
    
    public function collection()
    {
        return $this->paymentData;
    }

    public function headings(): array
    {
        return [
            'StudentNr',
            'Voornaam',
            'Achternaam',
            'Datum',
            'Bedrag'
        ];
    }

}