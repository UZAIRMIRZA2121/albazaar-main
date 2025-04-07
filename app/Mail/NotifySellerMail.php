<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotifySellerMail extends Mailable
{
    use Queueable, SerializesModels;

    public $orderDetails; // Declare as a public property

    /**
     * Create a new message instance.
     *
     * @param $orderDetails
     */
    public function __construct($orderDetails)
    {
        $this->orderDetails = $orderDetails; // Set the orderDetails
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // You can add additional info here if needed, like the seller's email.
        return $this->subject('You have new orders!')
                ->view('email-templates.notify-seller')
                    ->with(['orderDetails' => $this->orderDetails]); // Pass orderDetails to the view
    }
}
