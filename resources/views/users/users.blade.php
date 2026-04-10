@extends('layout.main')

@section('content')
<main class="container">
    <section class="page-section" data-ticket-page data-open-on-load="{{ request()->boolean('create') ? 'true' : 'false' }}">
        <div class="page-header">
            <h2>Users</h2>
        </div>

        <div class="filters">
            <input type="text" class="users-search-input" placeholder="Search users...">
            <select class="users-select">
                <option value="">All Types</option>
                <option value="Dev">Dev</option>
                <option value="Client">Client</option>
            </select>
        </div>

        <table class="tickets-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody data-ticket-list>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->role }}</td>
                    <td>{{ $user->email }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </section>
</main>
@endsection