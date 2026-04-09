@extends('layout.main')

@section('content')
<main class="container">
    <section class="page-section">
        <div class="page-header">
            <h2>Ticket details</h2>
            <a href="{{ route('tickets') }}" class="return-button">Take me back</a>
        </div>

        <div class="ticket-header">
            <div>
                <h2>ID : {{ $ticket->id }}</h2>
            </div>
            <div>
                <h2>Title : {{ $ticket->ticket_title }}</h2>
            </div>
            <div>
                <h2>Project : <a href="{{ route('projects.show', $ticket->project->id)}}">{{ $ticket->project->project_title }}</a></h2>
            </div>
        </div>

        <table class="tickets-table">
            <thead>
                <tr>
                    <th>Status</th>
                    <th>Priority</th>
                    <th>Type</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><span class="badge badge-{{ str_replace(' ', '-',$ticket->ticket_status) }}" >{{ $ticket->ticket_status }}</span></td>
                    <td><span class="priority priority-{{ $ticket->ticket_priority }}" >{{ $ticket->ticket_priority }}</span></td>
                    <td><span class="type type-{{ $ticket->included() }}" >{{ $ticket->included() }}</span></td>
                </tr>
            </tbody>
        </table>

        <table class="tickets-table">
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Assigned To</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $ticket->ticket_description }}</td>
                    <td>@if ($isAssigned) @foreach($devs as $dev)
                        {{ $dev->name }} <br>
                    @endforeach
                    @else Not Assigned @endif </td>
                </tr>
            </tbody>
        </table>

        <div class="ticket-header">
            <form action="{{ route('tickets.destroy') }}" method="POST">
                @csrf
                @method('DELETE')
                <input type="hidden" name="id" value="{{ $ticket->id }}">
                <button type="submit" class="submit-button">delete</button>
            </form>
            <a href="{{ route('tickets.edit', $ticket->id) }}" class="submit-button">Edit</a>
        </div>

        <section class="time-entries">
            <table class="tickets-table">
                <h3>Time</h3>
                <thead>
                    <tr>
                        <th>Time spent</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$ticket->length()}}h</td>
                    </tr>
                </tbody>
            </table>
            
            <h3>Time Entries</h3>
            <table class="tickets-table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Duration</th>
                        <th>Comment</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ticket->entries as $entry)
                        <tr>
                            <td>{{$entry->created_at}}</td>
                            <td>{{$entry->length}}h</td>
                            <td>{{$entry->comment}}</td>
                            <td><form action="{{ route('tickets.removeEntry') }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="id" value="{{ $entry->id }}">
                                <button type="submit" class="submit-button">delete</button>
                            </form></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="add-time-entry">
                <h4>Add New Time Entry</h4>
                <form class="time-entry-form" id="time-entry-form" action="{{ route('tickets.addEntry', $ticket->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="entry-date">Date:</label>
                        <input type="date" id="entry-date" name="Date">
                        <div id="date_error" class="error-text titanic">Please select a valid date.</div>
                    </div>
                    <div class="form-group">
                        <label for="entry-duration">Duration:</label>
                        <input type="time" id="entry-duration" name="Duration">
                        <div id="duration_error" class="error-text titanic">Please enter a valid duration (e.g., 1h 30m).</div> 
                    </div>
                    <div class="form-group">
                        <label for="entry-comment">Comment (Optional):</label>
                        <textarea id="entry-comment" name="Comment" placeholder="Add a comment about your work..." rows="3"></textarea>
                    </div>
                    <button type="submit" class="submit-button">Add Entry</button>
                </form>
            </div>
        </section>
    </section>
</main>
@endsection