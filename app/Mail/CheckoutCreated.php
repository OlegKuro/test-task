<?php

namespace App\Mail;

use App\Models\Checkout;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CheckoutCreated extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /** @var Checkout */
    public $checkout;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Checkout $checkout)
    {
        $this->checkout = $checkout;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from(config('mail.from.address'))
            ->view('emails.checkout_created')
            ->with([
                'customer' => $this->checkout->client_name,
                'address' => $this->checkout->client_address,
                'shipping' => $this->checkout->total_shipping_value,
                'price' => $this->checkout->total_product_value,
                'productName' => $this->checkout->product->name,
            ]);
    }
}
