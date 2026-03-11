<?php
    require_once 'dbaccess/ticket_list.php';
    require_once 'dbaccess/time_entry_list.php';

    $requestedId = isset($_GET['id']) ? $_GET['id'] : null;

    $ticket = null;
    if ($requestedId) {
        foreach ($tickets as $t) {
            if ($t['Ticket_ID'] == $requestedId) { $ticket = $t; break; }
        }
    }

    if (!$ticket) {
        $ticket = $tickets[0];
    }
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
                <li><a href="login.php" class="logout">Logout</a></li>
            </ul>
        </nav>
    </header>

    <main class="container">
        <section class="page-section">
            <div class="page-header">
                <h2>Ticket details</h2>
                <a href="tickets.php" class="return-button">Take me back</a>
            </div>

            <div class="ticket-header">
                <div>
                    <h2>ID : </h2>
                    <span><?= $ticket['Ticket_ID'] ?></span>
                </div>
                <div>
                    <h2>Title : </h2>
                    <span><?= $ticket['Ticket_Name'] ?></span>
                </div>
                <div>
                    <h2>Project : </h2>
                    <span><?= $ticket['Project_Nameexit'] ?></span>
                </div>
            </div>

            <table class="tickets-table">
                <thead>
                    <tr>
                        <th>Status</th>
                        <th>Priority</th>
                        <th>Type</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <?php $statusClass = 'badge-' . str_replace(' ', '-', strtolower($ticket['Status'])); ?>
                            <span class="badge <?= $statusClass ?>"><?= htmlspecialchars($ticket['Status']) ?></span>
                        </td>
                        <td><span class="priority priority-<?= strtolower($ticket['Priority']) ?>"><?= $ticket['Priority'] ?></span></td>
                        <td><span class="type type-<?= strtolower($ticket['Type']) ?>"><?= $ticket['Type'] ?></span></td>
                    </tr>
                </tbody>
            </table>

            <table class="tickets-table">
                <thead>
                    <tr>
                        <th>Description</th>
                        <th>Assigned To</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?= htmlspecialchars($ticket['Ticket_Description']) ?></td>
                        <td><?= htmlspecialchars($ticket['Assigned To']) ?></td>
                    </tr>
                </tbody>
            </table>

            <section class="time-entries">
                <table class="tickets-table">
                    <h3>Time</h3>
                    <thead>
                        <tr>
                            <th>Time spent</th>
                            <th>Time estimate</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?= $ticket['Time_Spent'] ?></td>
                            <td><?= $ticket['Duration_Estimate'] ?></td>
                        </tr>
                    </tbody>
                </table>
                
                <h3>Time Entries</h3>
                <table class="tickets-table">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Duration</th>
                            <th>Comment</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($timeentries as $entry): if ($entry['Ticket_ID'] === $ticket['Ticket_ID']): ?>
                            <tr>
                                <td><?= htmlspecialchars($entry['Date']) ?></td>
                                <td><?= htmlspecialchars($entry['Duration']) ?></td>
                                <td><?= htmlspecialchars($entry['Comment']) ?></td>
                            </tr>
                        <?php endif; endforeach; ?>
                    </tbody>
                </table>

                <div class="add-time-entry">
                    <h4>Add New Time Entry</h4>
                    <form class="time-entry-form" id="time-entry-form" action="dbaccess/time_entry_create.php?id=<?= $ticket['Ticket_ID'] ?>" method="POST">
                        <div class="form-group">
                            <label for="entry-date">Date:</label>
                            <input type="date" id="entry-date" name="Date">
                            <div id="date_error" class="error-text titanic">Please select a valid date.</div>
                        </div>
                        <div class="form-group">
                            <label for="entry-duration">Duration:</label>
                            <input type="time" id="entry-duration" name="Duration">
                            <div id="duration_error" class="error-text titanic">Please enter a valid duration (e.g., 1h 30m).</div> 
                        </div>
                        <div class="form-group">
                            <label for="entry-comment">Comment (Optional):</label>
                            <textarea id="entry-comment" name="Comment" placeholder="Add a comment about your work..." rows="3"></textarea>
                        </div>
                        <button type="submit" class="submit-button">Add Entry</button>
                    </form>
                </div>
            </section>
        </section>
    </main>

    <footer>
        <p>&copy; 2026 Ticketing Service. All rights reserved.</p>
    </footer>
    
    <script src="js/script.js"></script>
</body>
</html>
