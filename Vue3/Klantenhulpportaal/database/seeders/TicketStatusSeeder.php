<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TicketStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ticket_statuses')->insert([
            ['name' => 'Open', 'description' => 'Ticket has been created and is awaiting handling.'],
            ['name' => 'In Progress', 'description' => 'Ticket is currently being worked on.'],
            ['name' => 'Pending', 'description' => 'Waiting for customer response.'],
            ['name' => 'Resolved', 'description' => 'Issue has been resolved.'],
            ['name' => 'Closed', 'description' => 'Ticket is closed. Issue is not been resolved but will not be picked up.'],
            ['name' => 'Rejected', 'description' => 'Ticket was invalid or will not be processed.'],
        ]);
    }
}
