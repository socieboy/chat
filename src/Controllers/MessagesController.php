<?php

namespace Socieboy\Chat\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Socieboy\Chat\Entities\Message;
use Socieboy\Chat\Requests\SendMessageRequest;

class MessagesController extends Controller{

    function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request, Message $message)
    {
        $this->validate($request, [
            'from_user_id' => 'required',
            'to_user_id' => 'required'
        ]);

        $data = $request->all();

        return $message->where('from_user_id', $data['from_user_id'])
                       ->where('to_user_id', $data['to_user_id'])
                       ->orWhere('from_user_id', $data['to_user_id'])
                       ->orWhere('to_user_id', $data['from_user_id'])
                       ->orderBy('id', 'asc')->take(10)->get();

    }

    public function store(SendMessageRequest $request)
    {
        $this->dispatchFrom('Socieboy\Chat\Jobs\SendMessages', $request);
    }

} 