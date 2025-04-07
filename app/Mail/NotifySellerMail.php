<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotifySellerMail extends Mailable
{
    use Queueable, SerializesModels;

    public $orderDetails; // Declare as a public property
    public $sellerEmail; // Declare seller's email as a public property

    /**
     * Create a new message instance.
     *
     * @param $orderDetails
     * @param $sellerEmail
     */
    public function __construct($orderDetails, $sellerEmail)
    {
        $this->orderDetails = $orderDetails; // Set the orderDetails
        $this->sellerEmail = $sellerEmail;   // Set the seller's email
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('You have new orders!')
                    ->to($this->sellerEmail) // Set the recipient's email
                    ->view('email-templates.notify-seller')
                    ->with(['orderDetails' => $this->orderDetails]); // Pass orderDetails to the view
    }
}
