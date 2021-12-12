<?php

namespace App\Listeners;

use App\Events\UpdateInvoicedPurchases;
use App\Models\Purchase;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendInvoicedPurchases
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
     * @param  \App\Events\UpdateInvoicedPurchases  $event
     * @return void
     */
    public function handle(UpdateInvoicedPurchases $event)
    {
        Purchase::whereIn('id', $event->purchaseCollectionIds)->update(['status' => 'APROBADO']);
    }
}
