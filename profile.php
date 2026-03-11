<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - Ticketing Service</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="navbar-brand">
                <h1>Ticketing Service</h1>
            </div>
            <ul class="nav-links">
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="projects.php">Projects</a></li>
                <li><a href="tickets.php">Tickets</a></li>
                <li><a href="profile.php" class="active">Profile</a></li>
                <li><a href="parameters.php">Parameters</a></li>
                <li><a href="login.php" class="logout">Logout</a></li>
            </ul>
        </nav>
    </header>

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

    <footer>
        <p>&copy; 2026 Ticketing Service. All rights reserved.</p>
    </footer>

    <script src="js/script.js"></script>
</body>
</html>
