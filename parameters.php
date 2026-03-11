<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parameters - Ticketing Service</title>
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
                <li><a href="profile.php">Profile</a></li>
                <li><a href="parameters.php" class="active">Parameters</a></li>
                <li><a href="login.php" class="logout">Logout</a></li>
            </ul>
        </nav>
    </header>

    <main class="container">
        <section class="page-section">
            <div class="page-header">
                <h2>Settings & Parameters</h2>
            </div>

            <div class="settings-container">
                <div class="settings-menu">
                    <div class="settings-item active" data-section="general">
                        <h4>General Settings</h4>
                    </div>
                    <div class="settings-item" data-section="notifications">
                        <h4>Notifications</h4>
                    </div>
                </div>

                <div class="settings-content">
                    <!-- General Settings -->
                    <div class="settings-section active" id="general">
                        <h3>General Settings</h3>
                        <div class="settings-group">
                            <label for="language">Language:</label>
                            <select id="language">
                                <option value="en">English</option>
                                <option value="fr">Français</option>
                                <option value="de">Deutsch</option>
                            </select>
                        </div>
                        <div class="settings-group">
                            <label>Theme:</label>
                            <div class="radio-group">
                                <label>
                                    <input type="radio" name="theme" value="light" checked> Light
                                </label>
                                <label>
                                    <input type="radio" name="theme" value="dark"> Dark
                                </label>
                                <label>
                                    <input type="radio" name="theme" value="auto"> Auto (System)
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Notifications -->
                    <div class="settings-section" id="notifications">
                        <h3>Notification Preferences</h3>
                        <div class="settings-group checkbox-group">
                            <label>
                                <input type="checkbox" checked> Email notifications for new tickets
                            </label>
                        </div>
                        <div class="settings-group checkbox-group">
                            <label>
                                <input type="checkbox" checked> Email notifications for ticket updates
                            </label>
                        </div>
                        <div class="settings-group checkbox-group">
                            <label>
                                <input type="checkbox"> Email notifications for project updates
                            </label>
                        </div>
                        <div class="settings-group checkbox-group">
                            <label>
                                <input type="checkbox" checked> Browser notifications
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="settings-actions">
                <button class="btn btn-primary">Save Changes</button>
                <button class="btn btn-secondary">Reset to Defaults</button>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2026 Ticketing Service. All rights reserved.</p>
    </footer>

    <script src="js/script.js"></script>
</body>
</html>
