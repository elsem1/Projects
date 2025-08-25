<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use App\Http\Requests\StoreReplyRequest;
use App\Http\Requests\UpdateReplyRequest;
use App\Http\Resources\ReplyResource;
use App\Mail\NewReplyFromAdmin;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ReplyController extends Controller
{

    public function index()
    {
        return ReplyResource::collection(Reply::all());
    }

    public function store(StoreReplyRequest $request, Ticket $ticket)
    {
        $ticket->load('creator');

        $user = $request->user();
        $validated = $request->validated();

        $reply = Reply::create([
            ...$validated,
            'user_id' => Auth::id(),
            'ticket_id' => $ticket->id,
        ]);

        if ($user->is_admin && $ticket->creator) {
            Mail::to($ticket->creator->email)->send(new NewReplyFromAdmin($ticket, $reply, $user));
        }
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
