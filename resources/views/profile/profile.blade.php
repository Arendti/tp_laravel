
@extends('layout.main')

@section('content')


<main class="container">
    <section class="page-section">
        <div class="page-header">
            <h2>My Profile</h2>
        </div>

        <div class="profile-container">
            <div class="profile-header">
                <div class="profile-info">
                    <h3>John Doe</h3>
                    <p class="profile-role">Administrator</p>
                    <p class="profile-email">john.doe@company.com</p>
                </div>
            </div>

            <div class="profile-content">
                <div class="profile-section">
                    <h3>Personal Information</h3>
                    <div class="profile-field">
                        <label>Full Name:</label>
                        <p>John Doe</p>
                    </div>
                    <div class="profile-field">
                        <label>Email:</label>
                        <p>john.doe@company.com</p>
                    </div>
                    <div class="profile-field">
                        <label>Phone:</label>
                        <p>+33 1 23 45 67 89</p>
                    </div>
                    <div class="profile-field">
                        <label>Role:</label>
                        <p>Administrator</p>
                    </div>
                </div>

                <div class="profile-section">
                    <h3>Statistics</h3>
                    <div class="profile-stats">
                        <div class="stat">
                            <span class="stat-number">24</span>
                            <span class="stat-label">Tickets Assigned</span>
                        </div>
                        <div class="stat">
                            <span class="stat-number">18</span>
                            <span class="stat-label">Tickets Completed</span>
                        </div>
                        <div class="stat">
                            <span class="stat-number">156h</span>
                            <span class="stat-label">Hours Logged</span>
                        </div>
                        <div class="stat">
                            <span class="stat-number">43%</span>
                            <span class="stat-label">Completion Rate</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="profile-actions">
                <button class="btn btn-primary">Edit Profile</button>
            </div>
        </div>
    </section>
</main>

@endsection
