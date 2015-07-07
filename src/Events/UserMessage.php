<?php

namespace Socieboy\Chat\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UserMessage extends Event implements ShouldBroadcast
{
    use SerializesModels;

    /**
     * @var
     */
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
        return ['user-'. $this->message->to->id];
    }

    /**
     * Broadcast the user object
     *
     * @return array
     */
    public function broadcastWith()
    {
        return ['user' => $this->message->from];
    }
}
