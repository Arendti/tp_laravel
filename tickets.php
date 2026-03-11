<?php
    require_once 'dbaccess/ticket_list.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tickets - Ticketing Service</title>
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
                <li><a href="tickets.php" class="active">Tickets</a></li>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="parameters.php">Parameters</a></li>
                <li><a href="login.php" class="logout">Logout</a></li>
            </ul>
        </nav>
    </header>

    <main class="container">
        <section class="page-section">
            <div class="page-header">
                <h2>Tickets</h2>
                <a href="new_ticket.php" class="btn btn-primary">+ New Ticket</a>
            </div>

            <div class="filters">
                <input type="text" class="ticket-search-input" placeholder="Search tickets...">
                <select class="filter-select">
                    <option value="">All Status</option>
                    <option value="new">New</option>
                    <option value="in progress">In Progress</option>
                    <option value="waiting client">Waiting Client</option>
                    <option value="to be approved">To Be Approved</option>
                    <option value="done">Done</option>
                    <option value="refused">Refused</option>
                </select>
                <select class="filter-select">
                    <option value="">All Priority</option>
                    <option value="high">High</option>
                    <option value="medium">Medium</option>
                    <option value="low">Low</option>
                </select>
                <select class="filter-select">
                    <option value="">All Types</option>
                    <option value="included">Included</option>
                    <option value="chargeable">Chargeable</option>
                </select>
            </div>

            <table class="tickets-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Project</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Priority</th>
                        <th>Type</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tickets as $ticket): ?>
                        <tr>
                            <td><?= htmlspecialchars($ticket['Ticket_ID']) ?></td>
                            <td><a href="ticket_details.php?id=<?= urlencode($ticket['Ticket_ID']) ?>" class="ticket-link"><?= htmlspecialchars($ticket['Ticket_Name']) ?></a></td>
                            <td><a href="project_details.php?id=<?= urlencode($ticket['Project_ID']) ?>" class="ticket-link"><?= htmlspecialchars($ticket['Project_Name']) ?></a></td>
                            <td><?= htmlspecialchars($ticket['Ticket_Description']) ?></td>
                            <td>
                                <?php $statusClass = 'badge-' . str_replace(' ', '-', strtolower($ticket['Status'])); ?>
                                <span class="badge <?= $statusClass ?>"><?= htmlspecialchars($ticket['Status']) ?></span>
                            </td>
                            <td><span class="priority <?= 'priority-' . strtolower($ticket['Priority']) ?>"><?= htmlspecialchars($ticket['Priority']) ?></span></td>
                            <td><span class="type <?= 'type-' . strtolower($ticket['Type']) ?>"><?= htmlspecialchars($ticket['Type']) ?></span></td>
                            <td><a href="dbaccess/ticket/ticket_delete.php?delete=<?= $ticket['Ticket_ID'] ?>" class="btn-small btn-view">Delete</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="pagination">
                <button class="btn-page">&laquo; Previous</button>
                <span class="page-info">Page 1 of 5</span>
                <button class="btn-page">Next &raquo;</button>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2026 Ticketing Service. All rights reserved.</p>
    </footer>
    
    <script src="js/script.js"></script>
</body>
</html>
