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
        $validated = $request->validated();

        $note = Note::create([
            ...$validated,
            'user_id' => Auth::id(),
            'ticket_id' => $ticket->id,
        ]);

        return new NoteResource($note);
    }


    public function update(UpdateNoteRequest $request, Note $note)
    {
        $validated = $request->validated();

        $note->update($validated);

        return new NoteResource($note);
    }
}
