@extends('layout.main')

@section('content')
<main class="dashboard">
    <section class="dashboard-content">
        <h2>Welcome to Ticketing Service</h2>
        <div class="stats-container">
            <div class="stat-card">
                <h3>{{$projectCount}}</h3>
                <p>Active Projects</p>
            </div>
            @foreach($statusCounts as $status => $count)
            <div class="stat-card">
                <h3>{{$count}}</h3>
                <p>{{$status}}</p>
            </div>
            @endforeach
        </div>

        <div class="recent-section">
            <h3>Recent Tickets</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Project</th>
                        <th>Status</th>
                        <th>Priority</th>
                        <th>Type</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($tickets as $ticket)
                    <tr>
                        <td>{{ $ticket->id }}</td>
                        <td>{{ $ticket->ticket_title }}</td>
                        <td>{{ $ticket->project->project_title }}</td>
                        <td><span class="badge badge-{{ str_replace(' ', '-',$ticket->ticket_status) }}" >{{ $ticket->ticket_status }}</span></td>
                        <td><span class="priority priority-{{ $ticket->ticket_priority }}" >{{ $ticket->ticket_priority }}</span></td>
                        <td><span class="type type-{{ $ticket->included() }}" >{{ $ticket->included() }}</span></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </section>
</main>
@endsection