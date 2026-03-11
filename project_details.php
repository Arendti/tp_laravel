<?php
    require_once 'dbaccess/ticket_list.php';
    require_once 'dbaccess/project_list.php';

    // determine requested project by id (preferred)
    $requestedId = isset($_GET['id']) ? $_GET['id'] : null;

    $project = null;
    if ($requestedId) {
        foreach ($projects as $p) {
            if ($p['Project_ID'] == $requestedId) { $project = $p; break; }
        }
    }

    // default to first project if none matched
    if (!$project) {
        $project = $projects[0];
    }
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
                <li><a href="login.php" class="logout">Logout</a></li>
            </ul>
        </nav>
    </header>

    <main class="container">
        <section class="page-section">
            <div class="page-header">
                <h2>Project details</h2>
                <a href="projects.php" class="return-button">Take me back</a>
            </div>

            <div class="project-details">
                <h3><?= $project['Project_Name'] ?></h3>
                <p class="project-description"><?= $project['Project_Description'] ?></p>
                <div class="project-meta">
                    <table>
                        <tbody>
                            <tr>
                                <th>Manager:</th>
                                <td><?= $project['Dev_ID'] ?></td>
                            </tr>
                            <tr>
                                <th>Client:</th>
                                <td><?= $project['Client_ID'] ?></td>
                            </tr>
                            <tr>
                                <th>Included hours:</th>
                                <td><?= $project['Included_Hours'] ?></td>
                            </tr>
                            <tr>
                                <th>Validity:</th>
                                <td><?= $project['Start_Date'] ?> — <?= $project['End_Date'] ?></td>
                            </tr>
                            <tr>
                                <th>Hourly rate:</th>
                                <td><?= $project['Hourly_Rate'] ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="project-stats">
                    <h4>Time Summary</h4>            
                    <table>
                        <thead>
                            <tr>
                                <th>Time spent</th>
                                <th>Time remaining</th>
                                <th>Time charged</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><span class="time-spent">50h</span></td>
                                <td><span class="time-remaining">150h</span></td>
                                <td><span class="time-charged">4,250 €</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <div class="project-stats">
                    <h4>Tickets</h4>
                    <table>
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Time spent</th>
                                <th>Status</th>
                                <th>Priority</th>
                                <th>Type</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($tickets as $ticket): if ($ticket['Project_ID'] === $project['Project_ID']): ?>
                                <tr>
                                    <td><a href="ticket_details.php?id=<?= urlencode($ticket['Ticket_ID']) ?>" class="ticket-link"><?= htmlspecialchars($ticket['Ticket_Name']) ?></a></td>
                                    <td><?= htmlspecialchars($ticket['Time_Spent']) ?></td>
                                    <td>
                                        <?php $statusClass = 'badge-' . str_replace(' ', '-', strtolower($ticket['Status'])); ?>
                                        <span class="badge <?= $statusClass ?>"><?= htmlspecialchars($ticket['Status']) ?></span>
                                    </td>
                                    <td><span class="priority <?= 'priority-' . strtolower($ticket['Priority']) ?>"><?= htmlspecialchars($ticket['Priority']) ?></span></td>
                                    <td><span class="type <?= 'type-' . strtolower($ticket['Type']) ?>"><?= htmlspecialchars($ticket['Type']) ?></span></td>
                                </tr>
                            <?php endif; endforeach; ?>
                        </tbody>
                    </table>
                </div>
                
                <div class="project-stats">
                    <a href="dbaccess/project/project_delete.php?delete=<?= $project['Project_ID'] ?>" class="btn-small btn-view">Delete Project</a>
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
