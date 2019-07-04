<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TripRegistrationConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($aMailData)
    {
        $this->aMailData = $aMailData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(['address' => config('mail.from.address'), 'name' => config('mail.from.name')])
            ->replyTo(['address' => config('mail.from.address')])
            ->subject("Uw Inschrijving voor de buitenlandse reis")
            ->view('mails.registrationmail')
            ->with([
                'aData' => $this->aMailData,
            ]);
    }
}
