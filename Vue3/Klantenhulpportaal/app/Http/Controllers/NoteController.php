<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Http\Requests\StoreNoteRequest;
use App\Http\Requests\UpdateNoteRequest;
use App\Http\Resources\NoteResource;
use Illuminate\Support\Facades\Auth;
use App\Models\Ticket;
use Illuminate\Http\Resources\Json\ResourceCollection;

class NoteController extends Controller
{

    public function index()
    {
        return NoteResource::collection(Note::all());
    }

    public function store(StoreNoteRequest $request, Ticket $ticket)
    {
        // Controleer of user notes mag toevoegen
        if (!$request->user()->is_admin) {
            abort(403, 'Alleen admins kunnen notes toevoegen');
        }

        $validated = $request->validated();

        $note = Note::create([
            ...$validated,
            'user_id' => Auth::id(),
            'ticket_id' => $ticket->id,
        ]);

        return new NoteResource($note);
    }


    public function update(UpdateNoteRequest $request, Ticket $ticket, Note $note)
    {
        // Controleer of note bij dit ticket hoort
        if ($note->ticket_id !== $ticket->id) {
            abort(404, 'Note niet gevonden voor dit ticket');
        }

        // Controleer autorisatie
        if (!$request->user()->is_admin) {
            abort(403, 'Alleen admins kunnen notes bewerken');
        }
        $validated = $request->validated();
        $note->update($validated);

        return new NoteResource($note);
    }
}
