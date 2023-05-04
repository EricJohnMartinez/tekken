<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Events\ChatMessage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('chat.index');
    }

public function sendMessage(Request $request)
{
    $user = Auth::user();

    $message = new Message();
    $message->user_id = $user->id;
    $message->message = $request->input('message');
    $message->save();

    broadcast(new ChatMessage($user, $message))->toOthers();

    return response()->json(['status' => 'Message Sent!']);
}

    public function getMessages()
    {
        $messages = Message::with('user')->get();

        return response()->json($messages);
    }
}
