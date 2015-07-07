<?php

namespace Socieboy\Chat\Entities;


use Illuminate\Database\Eloquent\Model;

class Message extends Model{

    /**
     * @var string
     */
    protected $table = 'messages';

    /**
     * @var array
     */
    protected $fillable = ['message', 'from_user_id', 'to_user_id'];

    /**
     * Return the user who send the message.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function from()
    {
        return $this->belongsTo(config('chat.user.model'), 'from_user_id');
    }

    /**
     * Return the user who receive the message.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function to()
    {
        return $this->belongsTo(config('chat.user.model'), 'to_user_id');
    }

}