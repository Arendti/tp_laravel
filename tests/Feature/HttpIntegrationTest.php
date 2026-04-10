<?php

use App\Models\Ticket;
use App\Models\Project;
use App\Models\User;

test('ticket store creates ticket and attaches user', function () {
    $user = User::find(11);
    $project = Project::find(1);

    $this->actingAs($user);

    $data = [
        'Project_Name' => $project->id,
        'Ticket_Name' => 'Test Ticket',
        'Ticket_Description' => 'Test Description',
        'Status' => 'new',
        'Priority' => 'high',
        'Type' => '1',
    ];

    $response = $this->post(route('api.tickets.store'), $data);

    // $response->assertRedirect(route('tickets'));

    $this->assertDatabaseHas('tickets', [
        'project_id' => $project->id,
        'ticket_title' => 'Test Ticket',
        'ticket_description' => 'Test Description',
        'ticket_status' => 'new',
        'ticket_priority' => 'high',
        'ticket_included' => '1',
    ]);

    $ticket = Ticket::where('ticket_title', 'Test Ticket')->first();
    $this->assertTrue($ticket->users->contains($user));
});
