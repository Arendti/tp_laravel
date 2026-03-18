@extends('layout.main')

@section('content')
<main class="container">
    <section class="page-section">
        <div class="page-header">
            <h2>Create New Ticket</h2>
        </div>

        <form class="form-container" id="new-ticket-form" action="dbaccess/ticket/ticket_create.php" method="POST">
            <div class="form-section">
                <h3>Ticket Information</h3>
                
                <div class="form-group">
                    <label for="ticket-title">Title <span class="required">*</span></label>
                    <input type="text" id="ticket-title" name="Ticket_Name" placeholder="Enter ticket title">
                    <div class="error-text titanic" id="title-error">Title is required.</div>
                </div>

                <div class="form-group">
                    <label for="ticket-project">Project <span class="required">*</span></label>
                    <select id="ticket-project" name="Project_Name">
                        <option value="">Select a project</option>
                    </select>
                    <div class="error-text titanic" id="project-error">Project selection is required.</div>
                </div>

                <div class="form-group">
                    <label for="ticket-description">Description <span class="required">*</span></label>
                    <textarea id="ticket-description" name="Ticket_Description" placeholder="Provide a detailed description of the ticket..." rows="5"></textarea>
                    <div class="error-text titanic" id="description-error">Description is required.</div>
                </div>
            </div>

            <div class="form-section">
                <h3>Ticket Details</h3>

                <div class="form-row">
                    <div class="form-group">
                        <label for="ticket-status">Status <span class="required">*</span></label>
                        <select id="ticket-status" name="Status">
                            <option value="">Select status</option>
                            <option value="new">New</option>
                            <option value="in-progress">In Progress</option>
                            <option value="waiting-client">Waiting Client</option>
                            <option value="to-be-approved">To Be Approved</option>
                            <option value="done">Done</option>
                            <option value="refused">Refused</option>
                        </select>
                        <div class="error-text titanic" id="status-error">Status selection is required.</div>
                    </div>

                    <div class="form-group">
                        <label for="ticket-priority">Priority</label>
                        <select id="ticket-priority" name="Priority">
                            <option value="">Select priority</option>
                            <option value="high">High</option>
                            <option value="medium">Medium</option>
                            <option value="low">Low</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="ticket-type">Type <span class="required">*</span></label>
                        <select id="ticket-type" name="Type">
                            <option value="">Select type</option>
                            <option value="included">Included</option>
                            <option value="chargeable">Chargeable</option>
                        </select>
                        <div class="error-text titanic" id="type-error">Type selection is required.</div>
                    </div>

                    <div class="form-group">
                        <label for="ticket-estimate">Time Estimate</label>
                        <input type="time" id="ticket-estimate" name="Duration_Estimate">
                    </div>

                </div>

                <div class="form-group">
                    <label for="ticket-assigned">Assign To <span class="required">*</span></label>
                    <select id="ticket-assigned" name="User_Name">
                        <option value="">Select team member</option>
                    </select>
                    <div class="error-text titanic" id="assigned-error">Assignment is required.</div>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary" name="submit">Create Ticket</button>
                <a href="tickets.php" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </section>
</main>
@endsection