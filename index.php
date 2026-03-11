<?php
    require_once 'dbaccess/ticket_list.php';
    require_once 'dbaccess/project_list.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Ticketing Service</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="navbar-brand">
                <h1>Ticketing Service</h1>
            </div>
            <ul class="nav-links">
                <li><a href="dashboard.php" class="active">Dashboard</a></li>
                <li><a href="projects.php">Projects</a></li>
                <li><a href="tickets.php">Tickets</a></li>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="parameters.php">Parameters</a></li>
                <li><a href="login.php" class="logout">Logout</a></li>
            </ul>
        </nav>
    </header>

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
                        <?php foreach (array_slice($tickets, -3) as $ticket): ?>
                            <tr>
                                <td><?= htmlspecialchars($ticket['Ticket_ID']) ?></td>
                                <td><a href="ticket_details.php?id=<?= urlencode($ticket['Ticket_ID']) ?>" class="ticket-link"><?= htmlspecialchars($ticket['Ticket_Name']) ?></a></td>
                                <td><a href="project_details.php?id=<?= urlencode($ticket['Project_ID']) ?>" class="ticket-link"><?= htmlspecialchars($ticket['Project_Name']) ?></a></td>
                                <td>
                                    <?php $statusClass = 'badge-' . str_replace(' ', '-', strtolower($ticket['Status'])); ?>
                                    <span class="badge <?= $statusClass ?>"><?= htmlspecialchars($ticket['Status']) ?></span>
                                </td>
                                <td><span class="priority <?= 'priority-' . strtolower($ticket['Priority']) ?>"><?= htmlspecialchars($ticket['Priority']) ?></span></td>
                                <td><span class="type <?= 'type-' . strtolower($ticket['Type']) ?>"><?= htmlspecialchars($ticket['Type']) ?></span></td>
                                <td><button class="btn-small btn-view">View</button></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2026 Ticketing Service. All rights reserved.</p>
    </footer>

    <script src="js/script.js"></script>
</body>
</html>