@extends('layout.main')

@section('content')

<main class="container">
    <section class="page-section">
        <div class="page-header">
            <h2>Project details</h2>
            <a href="{{ route('projects') }}" class="return-button">Take me back</a>
        </div>

        <div class="project-details">
            <h3>{{ $project->project_title }}</h3>
            <p class="project-description">{{ $project->project_description }}</p>
            <div class="project-meta">
                <table>
                    <tbody>
                        <tr>
                            <th>Developpers:</th>
                            <td>@if ($isAssigned) @foreach($devs as $dev)
                                {{ $dev->name }} <br>
                            @endforeach
                            @else Not Assigned @endif </td>
                        </tr>
                        <tr>
                            <th>Client:</th>
                            <td>{{ $project->client->name }}</td>
                        </tr>
                        <tr>
                            <th>Included hours:</th>
                            <td>{{ $project->included_hours }}</td>
                        </tr>
                        <tr>
                            <th>Validity:</th>
                            <td>{{ $project->start_date }} — {{ $project->end_date }}</td>
                        </tr>
                        <tr>
                            <th>Hourly rate:</th>
                            <td>{{ $project->hourly_rate }}€</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="project-stats">
                <h4>Time Summary</h4>            
                <table>
                    <thead>
                        <tr>
                            <th>Time spent</th>
                            <th>Time remaining</th>
                            <th>Time charged</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><span class="time-spent">{{ $length}}h</span></td>
                            <td><span class="time-remaining">{{ max(0, $project->included_hours - $length)}}h</span></td>
                            <td><span class="time-charged">{{ max(0, $length - $project->included_hours)}}h</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <div class="project-stats">
                <h4>Tickets</h4>
                <table>
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Time spent</th>
                            <th>Status</th>
                            <th>Priority</th>
                            <th>Type</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tickets as $ticket)
                        <tr>
                            <td><a href="{{ route('tickets.show', $ticket->id) }}">{{ $ticket->ticket_title }}</a></td>
                            <td>{{$ticket->length()}}h</td>
                            <td><span class="badge badge-{{ str_replace(' ', '-',$ticket->ticket_status) }}" >{{ $ticket->ticket_status }}</span></td>
                            <td><span class="priority priority-{{ $ticket->ticket_priority }}" >{{ $ticket->ticket_priority }}</span></td>
                            <td><span class="type type-{{ $ticket->included() }}" >{{ $ticket->included() }}</span></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <br>
                @if ($role=="Admin" || $role=="Dev"): <a href="{{ route('new_ticket') }}" class="submit-button">+ New Ticket</a> @endif
            </div>
            
            @if ($role=="Admin" || $role=="Dev"): <div class="project-stats">
                <form action="{{ route('projects.destroy') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="id" value="{{ $project->id }}">
                    <button type="submit" class="submit-button">delete</button>
                </form>
            </div> 

            <div class="project-stats">
                <a href="{{ route('projects.edit', $project->id) }}" class="submit-button">Edit</a>
            </div> @endif
        </div>
    </section>
</main>

@endsection