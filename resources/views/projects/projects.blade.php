@extends('layout.main')

@section('content')
<main class="container">
    <section class="page-section">
        <div class="page-header">
            <h2>Projects</h2>
            @if ($role=="Admin" || $role=="Dev"): <a href="{{ route('new_project') }}" class="btn btn-primary">+ New Project</a> @endif
        </div>

        <div class="search-bar">
            <input type="text" class="project-search-input" name="project-search-input" placeholder="Search projects...">
        </div>

        <div class="projects-grid">
            <?php foreach ($projects as $project): ?>
                <div class="project-card" data-url="{{ route('projects.show', $project->id)}}">
                    <h3 class="project-title">{{$project->project_title}}</h3>
                    <p class="project-description">{{$project->project_description}}</p>
                    
                    <div class="project-stats">
                        <h4>Tickets</h4>
                        <table>
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Time spent</th>
                                    <th>Type</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($tickets[$project->project_title] as $ticket)
                                <tr>
                                    <td><a href="{{ route('tickets.show', $ticket->id) }}">{{ $ticket->ticket_title }}</a></td>
                                    <td>{{ $ticket->length() }}h</td>
                                    <td><span class="type type-{{ $ticket->included() }}" >{{ $ticket->included() }}</span></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</main>
@endsection