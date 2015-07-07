<?php

namespace Socieboy\Chat\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UserWasLoggedOut extends Event implements ShouldBroadcast
{
    use SerializesModels;

    public $session;
    /**
     * Create a new event instance.
     * @param $session
     */
    public function __construct($session)
    {
        $this->session = $session;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return ['chat'];
    }

    public function broadcastWith()
    {
        return [
            'user' => $this->session->user
        ];
    }
}