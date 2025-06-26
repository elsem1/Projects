<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use App\Models\Ticket;
use App\Models\Reply;
use App\Models\Note;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            TicketStatusSeeder::class,
        ]);

        Category::factory()->count(7)->create();

        User::factory()->count(5)->create(['is_admin' => 1]);
        User::factory()->count(20)->create(['is_admin' => 0]);

        $customers = User::where('is_admin', 0)->get();

        $customers->each(function ($customer) {
            $ticket = Ticket::factory()
                ->withCategories()
                ->create([
                    'created_by' => $customer->id,
                    'handled_by' => User::where('is_admin', 1)
                        ->inRandomOrder()->value('id'),
                ]);

            $replyCount = rand(0, 5);
            $lastReplyUserId = null;

            for ($i = 0; $i < $replyCount; $i++) {
                $userId = $i % 2 === 0
                    ? $ticket->created_by
                    : $ticket->handled_by;
                $lastReplyUserId = $userId;

                Reply::factory()->create([
                    'ticket_id' => $ticket->id,
                    'user_id' => $userId,
                ]);
            }

            if ($replyCount === 0) {
                $ticket->update(['status_id' => 1]);
            } elseif ($lastReplyUserId === $ticket->created_by) {
                $ticket->update(['status_id' => collect([2, 4, 5, 6])->random()]);
            } else {
                $ticket->update(['status_id' => rand(3, 6)]);
            }

            $noteCount = rand(0, ($replyCount - 1));
            for ($i = 0; $i < $noteCount; $i++) {
                Note::factory()->create([
                    'ticket_id' => $ticket->id,
                    'user_id' => $ticket->handled_by,
                ]);
            }
        });
    }
}
