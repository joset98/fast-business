<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UpdateInvoicedPurchases
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $purchaseCollectionIds;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($purchaseCollections)
    {
        $this->purchaseCollectionIds = $purchaseCollections;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
