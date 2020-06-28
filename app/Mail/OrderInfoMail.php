<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderInfoMail extends Mailable
{
    use Queueable, SerializesModels;
    public $all_order_info;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($all_order_info)
    {
        $this->all_order_info = $all_order_info;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('admin.mail.order-info-mail');
    }
}
