<?php

namespace Socieboy\Chat\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Socieboy\Chat\Entities\Session;
use Socieboy\Chat\Events\NewUserWasLogin;
use Socieboy\Chat\Events\SignInToChat;
use Socieboy\Chat\Requests\SignInRequest;

class UsersController extends Controller{

    function __construct()
    {
        $this->middleware('auth');
    }

    public function online(Session $session)
    {
        return $session->online();
    }

    public function getUser(Request $request)
    {
        $this->validate($request, ['id' => 'required|exists:users,id']);

        $user_class = (config('chat.user.model'));

        $user = new $user_class();

        return $user->whereId($request->only('id'))->first();

    }

} 