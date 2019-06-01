<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class providerpasswordreset extends Mailable
{
    use Queueable, SerializesModels;

public $otp;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($otp)
    {
        $this->otp=$otp;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(Request $request)
    {
          return $this->view('provider.auth.apiemail',['otp'=>$this->otp])->subject('Website Contact Form');
    }
}
