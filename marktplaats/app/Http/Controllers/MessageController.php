<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{

    public function index(Message $message)
    {
        $messages = Message::where(function ($query) {
            $query->where('receiver_id', Auth::user()->id)
                  ->orWhere('sender_id', Auth::user()->id);
        })->get();

        return view('messages.index', compact( 'messages'));
    }

    public function show(Message $message)
    {
        $message = Message::findOrFail($message->id);

        $message->update([
            'is_read' => true
        ]);

        $previousMessages = $message->previousMessages($message->sender_id, $message->receiver_id)->get();


        $originalSender = $previousMessages->last();


        return view('messages.show', [
            'message' => $message,
            'previousMessages' => $previousMessages,
            'originalSender' => $originalSender,
        ]);

    }

    public function create()
    {
            return view('messages.create');
    }


    public function createReply(Message $message)
    {
        return view('messages.reply', [
            'message' => $message,
            'recipient' => $message->sender
        ]);
    }


    public function reply(Request $request)
{
    // Validate the incoming request
    $request->validate([
        'message' => ['required', 'min:3', 'max:5000'],
    ]);
    dd(auth()->id());
    // Create a new message record
    $message = Message::create([
        'subject' => $request->subject,  // Get the subject from the form
        'message' => $request->message,  // Get the reply message from the form
        'sender_id' => auth()->id(),     // Sender is the authenticated user
        'receiver_id' => $request->receiver_id,  // Receiver is the original sender
    ]);

    // Optionally, you can retrieve the previous messages if you need to pass them to the view
    $previousMessages = $message->previousMessages($request->receiver_id, auth()->id())->get();

    // Redirect the user back to the message view page after sending the reply
    return redirect()->route('messages.show', ['message' => $message->id])  // Use correct syntax for passing parameters
                     ->with('Success', 'Message sent successfully.');
}




    public function destroy(Message $message)
    {
        $message->delete();

        return redirect()->route('messages.index');
    }
}
