<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\contract;

class ContractAlert extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($content)
    {
        $this->contract = $content;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //return dd($this);
        return $this->view('email.contract')
        ->with([
            'company' => $this->contract['company'],
            'contract' => $this->contract['contract'],
            ]);
    }
}
