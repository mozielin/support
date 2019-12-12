<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TLCAlert extends Mailable
{
    use Queueable, SerializesModels;

    protected  $seadmin;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($seadmin)
    {
        $this->seadmin = $seadmin;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {   
    //return dd($this);
        return $this->view('email.tlc')
		->subject($this->seadmin->title.'-到期通知')
        ->with([
            'tlc' => $this->seadmin,
            ]);
    }
}
