<?php

namespace App\Mail;

use App\Traveller;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InformationMail extends Mailable
{
    use Queueable, SerializesModels;
    
    private $aData = array();

    /**
     * Create a new message instance.
     *
     * @author Yoeri op't Roodt
     *
     * @return void
     */
    public function __construct($aData) {
        $this->aData = $aData;
    }

    /**
     * Build the message.
     *
     * @author Yoeri op't Roodt
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(['address' => config('mail.from.address'), 'name' => config('mail.from.name')])
            ->replyTo(['address' => $this->aData['contactMail']])
            ->subject($this->aData['subject'])
            ->view('mails.informationmail')
            ->with(['aData' => $this->aData]);
    }
}
