<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Ad;
use App\Mail\NewMessage;
use Illuminate\Support\Facades\Mail;

class MessageController extends Controller
{
    // Haal alle gesprekken op waarin de gebruiker betrokken is
    public function index()
    {
        $userId = Auth::user()->id;
        $conversations = Message::where(function ($query) use ($userId) {
            $query->where('receiver_id', $userId)
                ->orWhere('sender_id', $userId);
        })->orderBy('created_at', 'desc')
            ->get()
            ->groupBy('subject'); // Groepeer op onderwerp

        return view('messages.index', compact('conversations'));
    }

    // Toon een specifiek bericht en bijbehorende vorige berichten
    public function show(Message $message)
    {
        // TODO: vraag: waarom query je opnieuw de message als deze al via route-model-binding geladen is?
        $message = Message::findOrFail($message->id);
        $message->update(['is_read' => true]); // Markeer bericht als gelezen

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

        $originalSender = $previousMessages->first(); // Haal de oorspronkelijke afzender op

        return view('messages.show', [
            'message' => $message,
            'previousMessages' => $previousMessages,
            'originalSender' => $originalSender,
        ]);
    }

    // Maak een nieuw bericht aan gerelateerd aan een advertentie
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

    // Maak een nieuw reply aan
    public function createReply(Message $message)
    {
        return view('messages.reply', [
            'message' => $message,
            'recipient' => $message->sender
        ]);
    }

    // Verwerk een antwoordbericht
    public function reply(Request $request)
    {
        // Validatie
        $request->validate(['message' => ['required', 'min:3', 'max:5000']]);

        // Maak een nieuw bericht aan
        $message = Message::create([
            'subject' => $request->subject,
            'message' => $request->message,
            'sender_id' => Auth::user()->id,
            'receiver_id' => $request->receiver_id,
        ]);

        // Haal eerdere berichten uit hetzelfde gesprek op
        $previousMessages = $message->previousMessages($request->receiver_id, Auth::user()->id)->get();

        // Haal de ontvangende gebruiker op
        $user = User::where('id', $request->receiver_id)->first();

        // Controleer of de gebruiker notificaties wil ontvangen 
        if ($user->receive_notifications) {
            // Stuur een e-mail naar de ontvanger wanneer een antwoord wordt verzonden
            Mail::to($user)->send(new NewMessage($message->message, $user));
        }
        return redirect()->route('messages.show', ['message' => $message->id])
            ->with('Success', 'Message sent successfully.');
    }


    // Sla een nieuw bericht op
    public function store(Request $request)
    {
        $validated = $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Maak een nieuw bericht aan
        $message = new Message;
        $message->sender_id = Auth::id();
        $message->receiver_id = $validated['receiver_id'];
        $message->subject = $validated['subject'];
        $message->message = $validated['message'];
        $message->is_read = true; // Markeer het bericht als gelezen voor de zender en niet de ontvanger
        $message->save();

        // Haal de ontvangende gebruiker op
        $user = User::where('id', $validated['receiver_id'])->first();

        // Controleer of de gebruiker notificaties wil ontvangen 
        if ($user->receive_notifications) {
            // Stuur een e-mail naar de ontvanger wanneer er een nieuwe conversatie gestart wordt
            Mail::to($user)->send(new NewMessage($message->message, $user));
        }
        return redirect()->route('messages.index')->with('success', 'Message sent successfully!');
    }

    // Verwijder een bericht
    public function destroy(Message $message)
    {
        $message->delete();
        return redirect()->route('messages.index');
    }
}
