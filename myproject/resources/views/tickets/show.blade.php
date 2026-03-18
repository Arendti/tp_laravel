@extends('layout.main')

@section('content')
<main class="container">
    <section class="page-section">
        <div class="page-header">
            <h2>Ticket details</h2>
            <a href="tickets.php" class="return-button">Take me back</a>
        </div>

        <div class="ticket-header">
            <div>
                <h2>ID : </h2>
            </div>
            <div>
                <h2>Title : </h2>
            </div>
            <div>
                <h2>Project : </h2>
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
@endsection