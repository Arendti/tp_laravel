@extends('layout.main')

@section('content')
<main class="container">
    <section class="page-section">
        <div class="page-header">
            <h2>Projects</h2>
            <a href="new_project.php" class="btn btn-primary">+ New Project</a>
        </div>

        <div class="search-bar">
            <input type="text" class="project-search-input" placeholder="Search projects...">
        </div>

        <div class="projects-grid">
            <?php foreach ($projects as $project): ?>
                <div class="project-card">
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
                                    <td>{{ $ticket->ticket_title }}</td>
                                    <td>{{ $ticket->length() }}</td>
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