<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeCustomer extends Mailable
{
    use Queueable, SerializesModels;
    public $customer_info;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($customer_info)
    {
        $this->customer_info = $customer_info;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('site.mail.welcome-customer');
    }
}
