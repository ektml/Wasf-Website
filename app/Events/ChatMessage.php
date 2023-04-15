<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ChatMessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $msg;
    public $requestId;
    // request / reservation
    // App\Models\Requests / App\Models\Reservation

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($msg, $requestId)
    {
        $this->msg = $msg;
        $this->requestId = $requestId;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return ['chats'];
    }

    public function broadcastAs() {
        return 'new-message';
    }
    
}
