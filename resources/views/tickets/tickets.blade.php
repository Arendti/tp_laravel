@extends('layout.main')

@section('content')
<main class="container">
    <section class="page-section" data-ticket-page data-open-on-load="{{ request()->boolean('create') ? 'true' : 'false' }}">
        <div class="page-header">
            <h2>Tickets</h2>
            @if ($role=="Admin" || $role=="Dev"): <div>
                <button type="button" class="btn btn-secondary" data-open-ticket-modal>Quick Create</button>
                <a href="{{ route('new_ticket') }}" class="btn btn-primary">+ New Ticket</a> 
            </div> @endif
        </div>

        <div class="filters">
            <input type="text" class="ticket-search-input" placeholder="Search tickets...">
            <select class="filter-select">
                <option value="">All Status</option>
                <option value="new">New</option>
                <option value="in progress">In Progress</option>
                <option value="waiting client">Waiting Client</option>
                <option value="waiting validation">Waiting Validation</option>
                <option value="validated">Validated</option>
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
            <tbody data-ticket-list>
            @foreach($tickets as $ticket)
                <tr>
                    <td>{{ $ticket->id }}</td>
                    <td><a href="{{ route('tickets.show', $ticket->id) }}">{{ $ticket->ticket_title }}</a></td>
                    <td><a href="{{ route('projects.show', $ticket->project->id)}}">{{ $ticket->project->project_title }}</a></td>
                    <td>{{ $ticket->ticket_description }}</td>
                    <td><span class="badge badge-{{ str_replace(' ', '-',$ticket->ticket_status) }}" >{{ $ticket->ticket_status }}</span></td>
                    <td><span class="priority priority-{{ $ticket->ticket_priority }}" >{{ $ticket->ticket_priority }}</span></td>
                    <td><span class="type type-{{ $ticket->included() }}" >{{ $ticket->included() }}</span></td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <dialog class="ticket-modal" data-ticket-modal aria-labelledby="ticket-modal-title">
            <div class="ticket-modal-content">
                <div class="ticket-modal-header">
                    <h2 id="ticket-modal-title">Quick ticket creation</h2>
                    <button type="button" class="ticket-icon-button" data-close-ticket-modal aria-label="Fermer">&times;</button>
                </div>

                <form action="{{ route('api.tickets.store') }}" method="POST" class="ticket-form" data-ticket-api-form>
                    @csrf
                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                    
                    <label for="ticket-name">Title</label>
                    <input id="ticket-name" type="text" name="Ticket_Name" required maxlength="255">
                    
                    <label for="project-name">Project</label>
                    <select name="Project_Name" required>
                        <option value="">Select a project</option>
                        @foreach($projects ?? [] as $project)
                            <option value="{{ $project->id }}">{{ $project->project_title }}</option>
                        @endforeach
                    </select>
                    
                    <label for="ticket-description">Description</label>
                    <textarea name="Ticket_Description" required></textarea>
                    
                    <label for="status">Status</label>
                    <select name="Status" required>
                        <option value="new">New</option>
                        <option value="in progress">In Progress</option>
                        <option value="waiting client">Waiting Client</option>
                        <option value="waiting validation">Waiting Validation</option>
                        <option value="done">Done</option>
                        <option value="refused">Refused</option>
                    </select>
                    
                    <label for="priority">Priority</label>
                    <select name="Priority" required>
                        <option value="high">High</option>
                        <option value="medium">Medium</option>
                        <option value="low">Low</option>
                    </select>
                    
                    <label for="type">Type</label>
                    <select name="Type" required>
                        <option value="1">Included</option>
                        <option value="0">Chargeable</option>
                    </select>

                    <div class="ticket-form-actions">
                        <button type="button" class="ticket-secondary-button" data-close-ticket-modal>Cancel</button>
                        <button type="submit" class="ticket-primary-button" data-ticket-submit-button disabled>Send</button>
                    </div>
                </form>
            </div>
        </dialog>
    </section>
</main>
@endsection