<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ChatMessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $from, $to, $text, $chatsable_type, $chatsable_id, $type;
    // request / reservation
    // App\Models\Requests / App\Models\Reservation

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($from, $to, $text, $chatsable_type, $chatsable_id, $type)
    {
        $this->from = $from;
        $this->to = $to;
        $this->text = $text;
        $this->chatsable_type = $chatsable_type;
        $this->chatsable_id = $chatsable_id;
        $this->type = $type;
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
