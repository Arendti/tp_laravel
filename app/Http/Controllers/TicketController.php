<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;


class TicketController extends Controller
{
    public function tickets()
    {
        return view('tickets.tickets');
    }

    public function new_ticket()
    {
        return view('tickets.new_ticket');
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
