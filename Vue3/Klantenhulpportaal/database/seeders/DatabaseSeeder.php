<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ticket;
use App\Models\Reply;
use App\Models\Note;

class DatabaseSeeder extends Seeder
{
    public function run()
    {

        Ticket::factory()->count(10)->create()->each(function ($ticket) {
            $replyCount = rand(0, 5);

            for ($i = 0; $i < $replyCount; $i++) {
                $userId = $i % 2 === 0
                    ? $ticket->created_by
                    : $ticket->handled_by;

                Reply::factory()->create([
                    'ticket_id' => $ticket->id,
                    'user_id' => $userId,
                ]);
            }

            if ($replyCount === 0) {
                $ticket->update(['status_id' => 1]);
            } else {
                $ticket->update(['status_id' => rand(2, 6)]);
            }

            $noteCount = rand(0, $replyCount);
            for ($i = 0; $i < $noteCount; $i++) {
                Note::factory()->create([
                    'ticket_id' => $ticket->id,
                    'user_id' => $ticket->handled_by,
                ]);
            }
        });
    }
}
