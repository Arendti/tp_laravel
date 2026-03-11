<?php
    require_once 'dbaccess/ticket_list.php';
    require_once 'dbaccess/project_list.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projects - Ticketing Service</title>
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
                <li><a href="projects.php" class="active">Projects</a></li>
                <li><a href="tickets.php">Tickets</a></li>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="parameters.php">Parameters</a></li>
                <li><a href="login.php" class="logout">Logout</a></li>
            </ul>
        </nav>
    </header>

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
                    <div class="project-card" id="project-card-<?= $project['Project_ID'] ?>" data-id="<?= $project['Project_ID'] ?>">
                        <h3 class="project-title"><a href="project_details.php?id=<?= urlencode($project['Project_ID']) ?>"><?= htmlspecialchars($project['Project_Name']) ?></a></h3>
                        <p class="project-description"><?= htmlspecialchars($project['Description']) ?></p>
                        
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
                                <?php foreach ($tickets as $ticket): if ($ticket['Project_ID'] === $project['Project_ID']): ?>
                                    <tr>
                                        <td><a href="ticket_details.php?id=<?= urlencode($ticket['Ticket_ID']) ?>" class="ticket-link"><?= htmlspecialchars($ticket['Ticket_Name']) ?></a></td>
                                        <td><?= htmlspecialchars($ticket['Time spent']) ?></td>
                                        <td><span class="type <?= 'type-' . strtolower($ticket['Type']) ?>"><?= htmlspecialchars($ticket['Type']) ?></span></td>
                                    </tr>
                                <?php endif; endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2026 Ticketing Service. All rights reserved.</p>
    </footer>
    
    <script src="js/script.js"></script>
</body>
</html>
