<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Project;
use App\Models\Ticket;
use App\Models\Time_Entry;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'role' => 'Admin',
        ]);

        // fake() = Faker::create();

        // ─── Config ───────────────────────────────────────────
        $clientIds = User::whereIn('role', ['Client'])->pluck('id')->toArray();
        $devIds    = User::whereIn('role', ['Dev'])->pluck('id')->toArray();

        $ticketStatuses   = ['new', 'in progress', 'waiting client', 'done', 'waiting validation', 'validated', 'refused'];
        $ticketPriorities = ['low', 'medium', 'high'];

        // ─── Projects ─────────────────────────────────────────
        $projects = [];
        for ($i = 0; $i < 10; $i++) {
            $start = fake()->dateTimeBetween('-1 year', 'now');
            $end   = fake()->dateTimeBetween($start, '+1 year');

            $projects[] = [
                'client_id'           => fake()->randomElement($clientIds),
                'project_title'       => fake()->catchPhrase(),
                'project_description' => fake()->paragraph(3),
                'included_hours'      => fake()->randomElement([50, 100, 150, 200, 300]),
                'start_date'          => $start->format('Y-m-d'),
                'end_date'            => $end->format('Y-m-d'),
            ];
            Project::create($projects[$i]);
        }

        $projectIds = Project::all()->pluck('id')->toArray();

        // ─── Tickets ──────────────────────────────────────────
        $tickets = [];
        foreach ($projectIds as $projectId) {
            $ticketCount = fake()->numberBetween(3, 8);

            for ($i = 0; $i < $ticketCount; $i++) {
                $tickets[] = [
                    'project_id'         => $projectId,
                    'ticket_title'       => fake()->sentence(5),
                    'ticket_description' => fake()->paragraph(2),
                    'ticket_status'      => fake()->randomElement($ticketStatuses),
                    'ticket_priority'    => fake()->randomElement($ticketPriorities),
                    'ticket_included'    => fake()->boolean(75), // 75% chance true
                ];
                Ticket::create($tickets[$i]);
            }
        }

        $ticketIds = Ticket::all()->pluck('id')->toArray();

        // ─── Time Entries ─────────────────────────────────────
        $timeEntries = [];
        foreach ($ticketIds as $ticketId) {
            $entryCount = fake()->numberBetween(1, 5);

            for ($i = 0; $i < $entryCount; $i++) {
                $timeEntries[] = [
                    'user_id'   => fake()->randomElement($devIds),
                    'ticket_id' => $ticketId,
                    'comment'   => fake()->sentence(8),
                    'length'    => fake()->randomFloat(2, 0.25, 8), // hours, e.g. 0.25–8.00
                ];
                Time_Entry::create($timeEntries[$i]);
            }
        }
    }
}
