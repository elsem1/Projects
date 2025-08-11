<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use App\Http\Resources\TicketResource;
use App\Http\Resources\TicketFormResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Note;

class TicketController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();


        if ($user->is_admin) {
            // Haal tickets met gekoppelde categorieën, en users op
            $tickets = Ticket::with('categories', 'creator', 'handler',)->get();
        } else {
            $tickets = Ticket::where('created_by', $user->id)->with('categories')->get();
        }

        return TicketResource::collection($tickets);
    }

    public function store(StoreTicketRequest $request)
    {
        $validated = $request->validated();

        $ticket = Ticket::create([
            ...$validated,
            'created_by' => Auth::id(),
        ]);

        $ticket->categories()->attach($validated['categories']);

        return new TicketResource($ticket);
    }


    public function show(Ticket $ticket, Request $request)
    {
        $user = $request->user();

        $relations = [
            'categories',
            'creator',
            'handler'
        ];

        if ($user->is_admin) {
            $relations[] = 'notes.user';
        }

        $ticket->load($relations);

        return new TicketResource($ticket);
    }

    public function update(UpdateTicketRequest $request, Ticket $ticket)
    {
        $validated = $request->validated();

        $ticket->update($validated);

        if (isset($validated['categories'])) {
            $ticket->categories()->sync($validated['categories']);
        }

        return new TicketFormResource($ticket);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
        return response()->noContent();
    }
}
