<?php

namespace Socieboy\Chat\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ReadMessage extends Event implements ShouldBroadcast
{
    use SerializesModels;

    public $message;
    /**
     * Create a new event instance.
     * @param $message
     */
    public function __construct($message)
    {
        $this->message = $message;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return ['conversation-'. $this->message->to_user_id];
    }
}
