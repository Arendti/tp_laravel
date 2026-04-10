<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Project;
use App\Models\Ticket;
use App\Models\Time_Entry;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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

        User::factory()->create([
            'name' => 'Test2 User2',
            'email' => 'test2@example.com',
            'role' => 'Dev',
        ]);
        
        User::factory()->create([
            'name' => 'Test3 User3',
            'email' => 'test3@example.com',
            'role' => 'Client',
        ]);

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
                'hourly_rate'         => fake()->randomFloat(2, 10, 99),
                'start_date'          => $start->format('Y-m-d'),
                'end_date'            => $end->format('Y-m-d'),
            ];
            Project::create($projects[$i]);
        }

        $projectIds = Project::all()->pluck('id')->toArray();

        // ─── Tickets ──────────────────────────────────────────
        foreach ($projectIds as $projectId) {

            for ($i = 0; $i < 5; $i++) {
                Ticket::create([
                    'project_id'         => $projectId,
                    'ticket_title'       => fake()->sentence(5),
                    'ticket_description' => fake()->paragraph(2),
                    'ticket_status'      => fake()->randomElement($ticketStatuses),
                    'ticket_priority'    => fake()->randomElement($ticketPriorities),
                    'ticket_included'    => fake()->boolean(75), // 75% chance true
                ]);
            }
        }

        $ticketIds = Ticket::all()->pluck('id')->toArray();

        // ─── Time Entries ─────────────────────────────────────
        foreach ($ticketIds as $ticketId) {
            $entryCount = fake()->numberBetween(1, 5);

            for ($i = 0; $i < $entryCount; $i++) {
                Time_Entry::create([
                    'user_id'   => fake()->randomElement($devIds),
                    'ticket_id' => $ticketId,
                    'comment'   => fake()->sentence(8),
                    'length'    => fake()->numberBetween(1, 8),
                ]);
            }
        }

        // Populate the ticket_user pivot table from time entry activity
        Time_Entry::query()
            ->select('user_id', 'ticket_id')
            ->distinct()
            ->each(function ($entry) {
                DB::table('ticket_assignements')->updateOrInsert(
                    [
                        'user_id' => $entry->user_id,
                        'ticket_id' => $entry->ticket_id,
                    ],
                    [
                        'updated_at' => now(),
                        'created_at' => now(),
                    ]
                );
            });

        // User::all()->each(function ($user) {
        //     // Pick 1–3 random roles for each user
        //     $roleIds = Role::inRandomOrder()
        //         ->take(rand(1, 3))
        //         ->pluck('id');

        //     // Attach to pivot table without removing existing
        //     $user->tickets()->syncWithoutDetaching($roleIds);
        // });
    }
}
