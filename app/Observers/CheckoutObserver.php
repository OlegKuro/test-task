<?php

namespace App\Observers;

use App\Mail\CheckoutCreated;
use App\Models\Checkout;
use Illuminate\Support\Facades\Mail;

class CheckoutObserver
{
    /**
     * Handle the Checkout "created" event.
     *
     * @param  \App\Models\Checkout  $checkout
     * @return void
     */
    public function created(Checkout $checkout)
    {
        Mail::to(config('mail.administrator_email'))
            ->queue(new CheckoutCreated($checkout->load('product')));
    }
}
