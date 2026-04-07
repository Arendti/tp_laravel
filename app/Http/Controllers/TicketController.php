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
