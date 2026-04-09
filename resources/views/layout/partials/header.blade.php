<header>
    <nav class="navbar">
        <div class="navbar-brand">
            <h1>Ticketing Service</h1>
        </div>
        <ul class="nav-links">
            <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li><a href="{{ route('projects') }}">Projects</a></li>
            <li><a href="{{ route('tickets') }}">Tickets</a></li>
            <li><a href="{{ route('profile.edit') }}">Profile</a></li>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout">Logout</button>
            </form>
        </ul>
    </nav>
</header>