<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotifySellerMail extends Mailable
{
    use Queueable, SerializesModels;

    // Declare necessary properties
    protected $orderDetail;

    /**
     * Create a new message instance.
     *
     * @param mixed $orderDetail
     */
    public function __construct($orderDetail)
    {
        $this->orderDetail = $orderDetail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('You have new orders!')
                    ->view('emails.notify-seller')
                    ->with(['orderDetails' => $this->orderDetails]); // Pass all the order details
    }
}
