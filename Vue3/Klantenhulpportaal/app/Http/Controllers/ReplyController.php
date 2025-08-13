<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use App\Http\Requests\StoreReplyRequest;
use App\Http\Requests\UpdateReplyRequest;
use App\Http\Resources\ReplyResource;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;

class ReplyController extends Controller
{
    
    public function index()
    {
        return ReplyResource::collection(Reply::all());
    }

    public function store(StoreReplyRequest $request, Ticket $ticket)
    {
        $validated = $request->validated();

        $reply = Reply::create([
            ...$validated,
            'user_id' => Auth::id(),
            'ticket_id' => $ticket->id,
        ]);

        return new ReplyResource($reply);
    } 

    
    public function update(UpdateReplyRequest $request, Ticket $ticket, Reply $reply)
    {
        $validated = $request->validated();
        $reply->update($validated);

        return new ReplyResource($reply);
    }

    
    public function destroy(Ticket $ticket, Reply $reply)
    {
        $reply->delete();
        return response()->noContent();
    }
}
