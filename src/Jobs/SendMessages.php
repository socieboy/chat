<?php

namespace Socieboy\Chat\Jobs;

use App\Jobs\Job;
use Illuminate\Contracts\Bus\SelfHandling;
use Socieboy\Chat\Entities\Message;
use Socieboy\Chat\Events\ReadMessage;
use Socieboy\Chat\Events\UserMessage;

class SendMessages extends Job implements SelfHandling
{
    protected $message;

    protected $from_user_id;

    protected $to_user_id;

    /**
     * Create a new job instance.
     *
     * @param $message
     * @param $from_user_id
     * @param $to_user_id
     */
    public function __construct($message, $from_user_id, $to_user_id)
    {
        $this->message = $message;

        $this->from_user_id = $from_user_id;

        $this->to_user_id = $to_user_id;
    }

    /**
     * Execute the job.
     *
     * @param Message $message
     * @return void
     */
    public function handle(Message $message)
    {
        $message->fill([
            'message'       => $this->message,
            'from_user_id'  => $this->from_user_id,
            'to_user_id'    => $this->to_user_id
        ]);

        $message->save();

        event(new UserMessage($message));

        event(new ReadMessage($message));
    }
}
