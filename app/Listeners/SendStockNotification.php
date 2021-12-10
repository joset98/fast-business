<?php

namespace App\Listeners;

use App\Events\DiscountProductFromStock;
use App\Models\Product;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendStockNotification
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
     * @param  \App\Events\DiscountProductFromStock  $event
     * @return void
     */
    public function handle(DiscountProductFromStock $event)
    {
        $boughtProduct = Product::where('id', $event->purchase->product_id);
        $boughtProduct->decrement('stock', $event->purchase->quantity);
    }
}
