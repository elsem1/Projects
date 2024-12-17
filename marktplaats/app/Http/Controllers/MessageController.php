<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Ad;
// use App\Events\NewMessage;
use App\Mail\NewMessage;
use Illuminate\Support\Facades\Mail;


class MessageController extends Controller
{

    public function index()
    {
        $userId = Auth::user()->id;
        // Haal alle berichten op waarin de gebruiker betrokken is
        $conversations = Message::where(function ($query) use ($userId) {
            $query->where('receiver_id', $userId)
                ->orWhere('sender_id', $userId);
        })->orderBy('created_at', 'desc')
            ->get()
            ->groupBy('subject'); // Groepeer op onderwerp

        return view('messages.index', compact('conversations'));
    }



    public function show(Message $message)
    {
        $message = Message::findOrFail($message->id);

        $message->update([
            'is_read' => true
        ]);

        // Haal alle vorige berichten op met dezelfde zender en ontvanger, en hetzelfde onderwerp
        $previousMessages = Message::where(function ($query) use ($message) {
            $query->where('subject', $message->subject)
                ->where(function ($subQuery) use ($message) {
                    $subQuery->where('sender_id', $message->sender_id)
                        ->where('receiver_id', $message->receiver_id);
                })
                ->orWhere(function ($subQuery) use ($message) {
                    $subQuery->where('sender_id', $message->receiver_id)
                        ->where('receiver_id', $message->sender_id);
                });
        })
            ->orderBy('created_at', 'desc')
            ->get();

        $originalSender = $previousMessages->first();

        return view('messages.show', [
            'message' => $message,
            'previousMessages' => $previousMessages,
            'originalSender' => $originalSender,
        ]);
    }

    public function create(Ad $ad)
    {
        $receiver = $ad->user;
        $subject = $ad->title;

        return view('messages.create', [
            'receiver' => $receiver,
            'subject' => $subject,
            'ad' => $ad
        ]);
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
        // Validatie
        $request->validate([
            'message' => ['required', 'min:3', 'max:5000'],


        ]);

        // Maakt een nieuw bericht aan
        $message = Message::create([
            'subject' => $request->subject,
            'message' => $request->message,
            'sender_id' => Auth::user()->id,
            'receiver_id' => $request->receiver_id,
        ]);

        // Eerdere berichten uit zelfde gesprek worden in de view geladen
        $previousMessages = $message->previousMessages($request->receiver_id, Auth::user()->id)->get();


        return redirect()->route('messages.show', ['message' => $message->id])
            ->with('Success', 'Message sent successfully.');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $message = new Message;
        $message->sender_id = Auth::id();
        $message->receiver_id = $validated['receiver_id'];
        $message->subject = $validated['subject'];
        $message->message = $validated['message'];

        // Markeer het bericht als gelezen voor de zender, maar niet voor de ontvanger
        $message->is_read = true;

        $message->save();

        // Haal de ontvanger gebruiker op
        $user = User::where('id', $validated['receiver_id'])->first();

        // Aanroepen van het event
        // event(new NewMessage($message, $user));
        Mail::to($request->user())->send(new NewMessage($message->message, $user));

        return redirect()->route('messages.index')->with('success', 'Message sent successfully!');
    }


    public function destroy(Message $message)
    {
        $message->delete();

        return redirect()->route('messages.index');
    }
}
