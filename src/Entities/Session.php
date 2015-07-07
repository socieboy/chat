<?php

namespace Socieboy\Chat\Entities;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{

    public $timestamps = false;

    /**
     * Returns the user that belongs to this session.
     */
    public function user()
    {
        return $this->belongsTo(config('chat.user.model'));
    }

    /**
     * Returns all the online users with out the current authenticated user.
     */
    public function online()
    {
        $user_class = (config('chat.user.model'));

        $user = new $user_class();

        $auth_id = auth()->user()->id;

        $user_ids = $this->whereNotNull('user_id')
            ->where('user_id', '<>', $auth_id)
            ->get()
            ->lists('user_id');

        return $user->whereIn('id', $user_ids)->get();

    }

    /**
     * Get the session of the auth user.
     */
    public function getSession(){
        return $this->whereId(session()->getId())->get()->first();
    }

    /**
     * Set user_id null to offline
     */
    public function setOnline()
    {
        $session = $this->find(session()->getId());
        $session->user_id = auth()->user()->id;
        $session->save();
    }

    /**
     * Set user_id null to offline
     */
    public function setOffline()
    {
        $session = $this->getSession();
        $session->user_id = null;
        $session->save();
    }


    /**
     * Returns all the offline users.
     * @param $query
     */
    public function offline($query)
    {
        return $query->whereNull('user_id');
    }

    /**
     * Retur nthe
     */



    /**
     * Updates the session of the current user.
     */
    public function updateCurrentUser()
    {
        $user_id = auth()->check() ? auth()->user()->id : null;
        return $this->where('id', session()->getId())->update([
            'user_id' => $user_id
        ]);
    }



}