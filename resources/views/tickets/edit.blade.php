@extends('layout.main')

@section('content')
<main class="container">
    <section class="page-section">
        <div class="page-header">
            <h2>Edit Ticket</h2>
        </div>

        <form class="form-container" id="new-ticket-form" action="{{ route('tickets.update', $ticket->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-section">
                <h3>Ticket Information</h3>
                
                <div class="form-group">
                    <label for="ticket-title">Title <span class="required">*</span></label>
                    <input type="text" id="ticket-title" name="Ticket_Name" value="{{$ticket->ticket_title}}">
                    <div class="error-text titanic" id="title-error">Title is required.</div>
                </div>

                <div class="form-group">
                    <label for="ticket-project">Project <span class="required">*</span></label>
                    <select id="ticket-project" name="Project_Name">
                        <option value="">Select a project</option>
                        @foreach($projects as $project)
                            <option value="{{ $project->id }}" @if ($project->id == $ticket->project_id): selected @endif>{{ $project->project_title }}</option>
                        @endforeach
                    </select>
                    <div class="error-text titanic" id="project-error">Project selection is required.</div>
                </div>

                <div class="form-group">
                    <label for="ticket-description">Description <span class="required">*</span></label>
                    <textarea id="ticket-description" name="Ticket_Description" rows="5">{{$ticket->ticket_description}}</textarea>
                    <div class="error-text titanic" id="description-error">Description is required.</div>
                </div>
            </div>

            <div class="form-section">
                <h3>Ticket Details</h3>

                <div class="form-row">
                    <div class="form-group">
                        <label for="ticket-status">Status <span class="required">*</span></label>
                        <select id="ticket-status" name="Status">
                            <option value="">Select status</option>
                            <option value="new" @if ($ticket->ticket_status == "new"): selected @endif>New</option>
                            <option value="in progress" @if ($ticket->ticket_status == "in progress"): selected @endif>In Progress</option>
                            <option value="waiting client" @if ($ticket->ticket_status == "waiting client"): selected @endif>Waiting Client</option>
                            <option value="waiting validation" @if ($ticket->ticket_status == "waiting validation"): selected @endif>Waiting validation</option>
                            <option value="done" @if ($ticket->ticket_status == "done"): selected @endif>Done</option>
                            <option value="refused" @if ($ticket->ticket_status == "refused"): selected @endif>Refused</option>
                        </select>
                        <div class="error-text titanic" id="status-error">Status selection is required.</div>
                    </div>

                    <div class="form-group">
                        <label for="ticket-priority">Priority <span class="required">*</span></label>
                        <select id="ticket-priority" name="Priority">
                            <option value="">Select priority</option>
                            <option value="high" @if ($ticket->ticket_priority == "high"): selected @endif>High</option>
                            <option value="medium" @if ($ticket->ticket_priority == "medium"): selected @endif>Medium</option>
                            <option value="low" @if ($ticket->ticket_priority == "low"): selected @endif>Low</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="ticket-type">Type <span class="required">*</span></label>
                        <select id="ticket-type" name="Type">
                            <option value="">Select type</option>
                            <option value="1" @if ($ticket->ticket_included): selected @endif>Included</option>
                            <option value="0" @if (!$ticket->ticket_included): selected @endif>Chargeable</option>
                        </select>
                        <div class="error-text titanic" id="type-error">Type selection is required.</div>
                    </div>

                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary" name="submit">Edit Ticket</button>
                <a href="{{ route('tickets.show', $ticket->id)}}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </section>
</main>
@endsection