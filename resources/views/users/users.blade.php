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
                    <form action="{{ route('users.edit') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <td>{{ $user->name }}</td>
                        <td><select id="role" name="role">
                            <option value="">Guest</option>
                            <option value="Dev" @if ($user->role == "Dev"): selected @endif>Dev</option>
                            <option value="Client" @if ($user->role == "Client"): selected @endif>Client</option>
                        </select></td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <input type="hidden" name="id" value="{{ $user->id }}">
                            <button type="submit" class="submit-button">edit</button>
                        </td>
                    </form>
                </tr>
            @endforeach
            </tbody>
        </table>
    </section>
</main>
@endsection