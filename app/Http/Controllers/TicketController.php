<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Ticket;
use App\Models\User;
use App\Models\Project;
use App\Models\Time_Entry;


class TicketController extends Controller
{
    public function tickets()
    {
        $user = auth()->user();
        if ($user->role == 'Admin'){
            $tickets = Ticket::all();
            $projects = Project::all();
        }
        elseif ($user->role == 'Dev'){
            $tickets = $user->tickets;
            $projects = $user->projects;
        }

        return view('tickets.tickets', [
            "tickets" => $tickets, 
            "projects" => $projects,
        ]);
    }

    public function dashboard()
    {
        $user = auth()->user();
        if ($user->role == 'Admin'){
            $tickets = Ticket::all();
        }
        elseif ($user->role == 'Dev'){
            $tickets = $user->tickets;
        }
        $statusCounts = [
            'new' => 0,
            'in progress' => 0,
            'waiting client' => 0,
            'done' => 0,
            'waiting validation' => 0,
            'validated' => 0,
            'refused' => 0,
        ];

        $projects = [];

        foreach ($tickets as $ticket){
            $statusCounts[$ticket->ticket_status]++;
            $projects[$ticket->project->project_title] = "";
        }

        return view('tickets.dashboard', [
            "tickets" => $tickets,
            "statusCounts" => $statusCounts,
            "projectCount" => count($projects),
        ]);
    }

    public function new_ticket()
    {
        $user = auth()->user();
        if ($user->role == 'Admin'){
            $projects = Project::all();
        }
        elseif ($user->role == 'Dev'){
            $projects = $user->projects;
        }

        return view('tickets.new_ticket', [
            "projects" => $projects,
        ]);
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        
        $validated = $request->validate([
            'Project_Name' => ['required', 'integer'],
            'Ticket_Name' => ['required', 'string', 'max:255'],
            'Ticket_Description' => ['required', 'string', 'max:255'],
            // 'Status' => ['required', 'string', 'max:255'],
            'Priority' => ['required', 'string', 'max:255'],
            'Type' => ['required', 'string'],
        ]);

        $project = Project::find($validated['Project_Name']);
        
        if ($user->role != 'Admin' && !$project->devs->contains($user)){
            return redirect()->route('tickets');
        }

        $ticket = Ticket::create([
            "project_id" => $validated['Project_Name'],
            "ticket_title" => $validated['Ticket_Name'],
            "ticket_description" => $validated['Ticket_Description'],
            "ticket_status" => "new",
            "ticket_priority" => $validated['Priority'],
            "ticket_included" => $validated['Type'],
        ]);

        $ticket->users()->attach($user->id); // Attach the authenticated user

        return redirect()->route('tickets');
    }

    public function storeApi(Request $request)
    {        
        $validated = $request->validate([
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'Project_Name' => ['required', 'integer'],
            'Ticket_Name' => ['required', 'string', 'max:255'],
            'Ticket_Description' => ['required', 'string', 'max:255'],
            'Status' => ['required', 'string', 'max:255'],
            'Priority' => ['required', 'string', 'max:255'],
            'Type' => ['required', 'string'],
        ]);

        $user = User::find($validated['user_id']);
        $project = Project::find($validated['Project_Name']);
        
        if ($user->role != 'Admin' && !$project->devs->contains($user)){
            return response()->json([
                'message' => 'Ticket refused.',
            ], 201);
        }

        $ticket = Ticket::create([
            "project_id" => $validated['Project_Name'],
            "ticket_title" => $validated['Ticket_Name'],
            "ticket_description" => $validated['Ticket_Description'],
            "ticket_status" => $validated['Status'],
            "ticket_priority" => $validated['Priority'],
            "ticket_included" => $validated['Type'],
        ]);
        
        $ticket->users()->attach($user);


        return response()->json([
            'message' => 'Ticket ajoute avec succes.',
            'ticket' => [
                'id' => $ticket->id,
                'title' => $ticket->ticket_title,
                'user_name' => $user->name,
                'show_url' => route('tickets.show', $ticket->id),
                'edit_url' => route('tickets.edit', $ticket->id),
                'destroy_url' => route('tickets.destroy'),
            ],
        ], 201);
    }

    public function addEntry(Request $request, $id)
    {
        $user = auth()->user();
        $ticket = Ticket::find($id);
        
        if ($user->role != 'Admin' && !$ticket->users->contains($user)){
            return redirect()->route('tickets');
        }

        $validated = $request->validate([
            'Date' => ['required', 'date'],
            'Duration' => ['required', 'regex:/^\d{2}:\d{2}$/'], // HH:MM format
            'Comment' => ['nullable', 'string'],
        ]);

        // Convert HH:MM to decimal hours
        list($hours, $minutes) = explode(':', $validated['Duration']);
        $length = (int)$hours;

        Time_Entry::create([
            'user_id' => $user->id,
            'ticket_id' => $id,
            'date' => $validated['Date'],
            'length' => $length,
            'comment' => $validated['Comment'],
        ]);

        return redirect()->route('tickets.show', $id);
    }

    public function removeEntry(Request $request)
    {
        $validated = $request->validate([
            'id' => ['required', 'integer', 'exists:time_entries,id'],
        ]);

        $entry = Time_Entry::findOrFail($validated['id']);

        $user = auth()->user();

        $ticket = $entry->ticket;
        
        if ($user->role != 'Admin' && !$ticket->users->contains($user)){
            return redirect()->route('tickets');
        }

        $entry->delete();

        return redirect()->route('tickets.show', $ticket->id);
    }

    public function show($id)
    {
        $ticket = Ticket::find($id);     
        
        $user = auth()->user();
        
        if ($user->role != 'Admin' && !$ticket->users->contains($user)){
            return redirect()->route('tickets');
        }

        $isAssigned = $ticket->isAssigned();
        $devs = $ticket->users;

        return view('tickets.show', [
            "ticket" => $ticket,
            "isAssigned" => $isAssigned,
            "devs" => $devs,
        ]);
    }

    public function edit($id)
    {
        $ticket = Ticket::find($id);     
        
        $user = auth()->user();
        
        if ($user->role != 'Admin' && !$ticket->users->contains($user)){
            return redirect()->route('tickets');
        }

        if ($user->role == 'Admin'){
            $projects = Project::all();
        }
        elseif ($user->role == 'Dev'){
            $projects = $user->projects;
        }

        return view('tickets.edit', [
            "ticket" => $ticket,
            "projects" => $projects,
        ]);
    }

    public function update(Request $request, $id)
    {
        $ticket = Ticket::find($id);     
        
        $user = auth()->user();
        
        if ($user->role != 'Admin' && !$ticket->users->contains($user)){
            return redirect()->route('tickets');
        }

        $validated = $request->validate([
            'Project_Name' => ['required', 'integer'],
            'Ticket_Name' => ['required', 'string', 'max:255'],
            'Ticket_Description' => ['required', 'string', 'max:255'],
            'Status' => ['required', 'string', 'max:255'],
            'Priority' => ['required', 'string', 'max:255'],
            'Type' => ['required', 'string'],
        ]);

        $ticket->update([
            "project_id" => $validated['Project_Name'],
            "ticket_title" => $validated['Ticket_Name'],
            "ticket_description" => $validated['Ticket_Description'],
            "ticket_status" => $validated['Status'],
            "ticket_priority" => $validated['Priority'],
            "ticket_included" => $validated['Type'],
        ]);

        return redirect()->route('tickets.show', $id);
    }

    public function destroy(Request $request)
    {
        $validated = $request->validate([
            'id' => ['required', 'integer', 'exists:tickets,id'],
        ]);

        $ticket = Ticket::findOrFail($validated['id']);

        $user = auth()->user();
        
        if ($user->role != 'Admin' && !$ticket->users->contains($user)){
            return redirect()->route('tickets');
        }

        $ticket->delete();

        return redirect()->route('tickets');
    }
}
