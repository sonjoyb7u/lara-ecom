<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactUsMail extends Mailable
{
    use Queueable, SerializesModels;
    public $contact_us_info_detail;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($contact_us_info_detail)
    {
        $this->contact_us_info_detail = $contact_us_info_detail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('site.mail.contact-us-mail');
//        return $this->html("Thanks for Contact with Us.");
    }
}
