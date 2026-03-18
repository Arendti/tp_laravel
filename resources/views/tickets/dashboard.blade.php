@extends('layout.main')

@section('content')
<main class="dashboard">
    <section class="dashboard-content">
        <h2>Welcome to Ticketing Service</h2>
        <div class="stats-container">
            <div class="stat-card">
                <h3>5</h3>
                <p>Active Projects</p>
            </div>
            <div class="stat-card">
                <h3>23</h3>
                <p>Open Tickets</p>
            </div>
            <div class="stat-card">
                <h3>12</h3>
                <p>In Progress</p>
            </div>
            <div class="stat-card">
                <h3>8</h3>
                <p>Closed Tickets</p>
            </div>
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
                    
                </tbody>
            </table>
        </div>
    </section>
</main>
@endsection