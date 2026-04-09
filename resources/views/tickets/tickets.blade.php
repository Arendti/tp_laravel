@extends('layout.main')

@section('content')
<main class="container">
    <section class="page-section">
        <div class="page-header">
            <h2>Tickets</h2>
            <a href="{{ route('new_ticket') }}" class="btn btn-primary">+ New Ticket</a>
        </div>

        <div class="filters">
            <input type="text" class="ticket-search-input" placeholder="Search tickets...">
            <select class="filter-select">
                <option value="">All Status</option>
                <option value="new">New</option>
                <option value="in progress">In Progress</option>
                <option value="waiting client">Waiting Client</option>
                <option value="to be approved">To Be Approved</option>
                <option value="done">Done</option>
                <option value="refused">Refused</option>
            </select>
            <select class="filter-select">
                <option value="">All Priority</option>
                <option value="high">High</option>
                <option value="medium">Medium</option>
                <option value="low">Low</option>
            </select>
            <select class="filter-select">
                <option value="">All Types</option>
                <option value="included">Included</option>
                <option value="chargeable">Chargeable</option>
            </select>
        </div>

        <table class="tickets-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Project</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Priority</th>
                    <th>Included</th>
                </tr>
            </thead>
            <tbody>
            @foreach($tickets as $ticket)
                <tr>
                    <td>{{ $ticket->id }}</td>
                    <td><a href="{{ route('tickets.show', $ticket->id) }}">{{ $ticket->ticket_title }}</a></td>
                    <td>{{ $ticket->project->project_title }}</td>
                    <td>{{ $ticket->ticket_description }}</td>
                    <td><span class="badge badge-{{ str_replace(' ', '-',$ticket->ticket_status) }}" >{{ $ticket->ticket_status }}</span></td>
                    <td><span class="priority priority-{{ $ticket->ticket_priority }}" >{{ $ticket->ticket_priority }}</span></td>
                    <td><span class="type type-{{ $ticket->included() }}" >{{ $ticket->included() }}</span></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </section>
</main>
@endsection