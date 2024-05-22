<?php

namespace App\Listeners;

use App\Events\NotifController;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AppsListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\NotifController  $event
     * @return void
     */
    public function handle(NotifController $event)
    {
        $order = $event->order;
        Mail::to($order->customer_email)->send(new OrderConfirmation($order));
    }
}
