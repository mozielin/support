<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\License;

class LicenseAlert extends Mailable
{
    use Queueable, SerializesModels;

    protected  $license;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($udata)
    {
        $this->license = $udata;

        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {   
        //return dd($this);
        return $this->view('email.license')
		->subject($this->license->lic_name.'-到期通知')
        ->with([
            'license' => $this->license,
            ]);
    }
}
