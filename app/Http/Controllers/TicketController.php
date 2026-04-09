<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Ticket;
use App\Models\User;
use App\Models\Project;


class TicketController extends Controller
{
    public function tickets()
    {
        $user = auth()->user();
        if ($user->role == 'Admin'){
            $tickets = Ticket::all();
        }
        elseif ($user->role == 'Dev'){
            $tickets = $user->tickets;
        }

        return view('tickets.tickets', [
            "tickets" => $tickets, 
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

    public function show($id)
    {
        $ticket = Ticket::find($id);

        if(auth()->id() != $ticket->user_id) {
            return redirect()->route('tickets.index');
        }

        return view('tickets.show', [
            "ticket" => $ticket,
        ]);
    }
}
