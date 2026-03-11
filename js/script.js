// document.querySelector('form').addEventListener('submit', function(event) {
//     event.preventDefault();
// });

// Login Form Validation
function validateLoginForm(event) {
    
    const emailInput = document.querySelector('#email');

    if (emailInput.value == "" || !emailInput.value.includes('@')) {
        document.querySelector('#email_error').classList.remove('titanic');
    } else {
        document.querySelector('#email_error').classList.add('titanic');
    }
    
    const passwordInput = document.querySelector('#password');
    if (passwordInput.value == "" || passwordInput.value.length < 8) {
        document.querySelector('#password_error').classList.remove('titanic');
    } else {
        document.querySelector('#password_error').classList.add('titanic');
    }
}

//const loginForm = document.querySelector('#login-form');
// if (loginForm) {
//     loginForm.addEventListener('submit', function(event) {
//         event.preventDefault();
//         validateLoginForm(event);
//     });
// }

// Signup Form Validation
function validateSignupForm(event) {
    const nameInput = document.querySelector('#signup-name');
    const emailInput = document.querySelector('#signup-email');
    const passwordInput = document.querySelector('#signup-password');
    const confirmPasswordInput = document.querySelector('#signup-confirm');

    if (nameInput.value == "") {
        document.querySelector('#signup-name-error').classList.remove('titanic');
    } else {
        document.querySelector('#signup-name-error').classList.add('titanic');
    }

    if (emailInput.value == "" || !emailInput.value.includes('@')) {
        document.querySelector('#signup-email-error').classList.remove('titanic');
    } else {
        document.querySelector('#signup-email-error').classList.add('titanic');
    }

    if (passwordInput.value == "" || passwordInput.value.length < 8) {
        document.querySelector('#signup-password-error').classList.remove('titanic');
    } else {
        document.querySelector('#signup-password-error').classList.add('titanic');
    }

    if (confirmPasswordInput.value != passwordInput.value) {
        document.querySelector('#signup-confirm-error').classList.remove('titanic');
    } else {
        document.querySelector('#signup-confirm-error').classList.add('titanic');
    }
}

const signupForm = document.querySelector('#signup-form');
if (signupForm) {
    signupForm.addEventListener('submit', function(event) {
        event.preventDefault();
        validateSignupForm(event);
    });
}

// Forgot Password Form Validation
function validateForgotPasswordForm(event) {
    const emailInput = document.querySelector('#forgot-email');

    if (emailInput.value == "" || !emailInput.value.includes('@')) {
        document.querySelector('#forgot-email-error').classList.remove('titanic');
    } else {
        document.querySelector('#forgot-email-error').classList.add('titanic');
    }
}

const forgotPasswordForm = document.querySelector('#forgot-password-form');
if (forgotPasswordForm) {
    forgotPasswordForm.addEventListener('submit', function(event) { 
        event.preventDefault();
        validateForgotPasswordForm(event);
    });
}

// Time Entry Form Validation
function validateTimeEntryForm(event) {
    const dateInput = document.querySelector('#entry-date');
    const durationInput = document.querySelector('#entry-duration');

    if (dateInput.value == "") {
        document.querySelector('#date_error').classList.remove('titanic');
    } else {
        document.querySelector('#date_error').classList.add('titanic');
    }

    const durationPattern = /^\d+h\s\d+m$/; // Simple pattern for "1h 30m"
    if (durationInput.value == "" || !durationPattern.test(durationInput.value)) {
        document.querySelector('#duration_error').classList.remove('titanic');
    } else {
        document.querySelector('#duration_error').classList.add('titanic');
    }
}

const timeEntryForm = document.querySelector('#time-entry-form');
if (timeEntryForm) {
    timeEntryForm.addEventListener('submit', function(event) {
        validateTimeEntryForm(event);
    });
}

// New Ticket Form Validation
function validateNewTicketForm(event) {
    const titleInput = document.querySelector('#ticket-title');
    const projectInput = document.querySelector('#ticket-project');
    const descriptionInput = document.querySelector('#ticket-description');
    const statusInput = document.querySelector('#ticket-status');
    const typeInput = document.querySelector('#ticket-type');
    const assignedInput = document.querySelector('#ticket-assigned');

    if (titleInput.value == "") {
        document.querySelector('#title-error').classList.remove('titanic');
    } else {
        document.querySelector('#title-error').classList.add('titanic');
    }

    if (projectInput.value == "") {
        document.querySelector('#project-error').classList.remove('titanic');
    } else {
        document.querySelector('#project-error').classList.add('titanic');
    }

    if (descriptionInput.value == "") {
        document.querySelector('#description-error').classList.remove('titanic');
    } else {
        document.querySelector('#description-error').classList.add('titanic');
    }

    if (statusInput.value == "") {
        document.querySelector('#status-error').classList.remove('titanic');
    } else {
        document.querySelector('#status-error').classList.add('titanic');
    }

    if (typeInput.value == "") {
        document.querySelector('#type-error').classList.remove('titanic');
    } else {
        document.querySelector('#type-error').classList.add('titanic');
    }

    if (assignedInput.value == "") {
        document.querySelector('#assigned-error').classList.remove('titanic');
    } else {
        document.querySelector('#assigned-error').classList.add('titanic');
    }
}

const newTicketForm = document.querySelector('#new-ticket-form');
if (newTicketForm) {
    newTicketForm.addEventListener('submit', function(event) {
        validateNewTicketForm(event);
    });
}

// New Project Form Validation
function validateNewProjectForm(event) {
    const nameInput = document.querySelector('#project-name');
    const descriptionInput = document.querySelector('#project-description');
    const includedHoursInput = document.querySelector('#project-included-hours');
    const hourlyRateInput = document.querySelector('#project-hourly-rate');
    const startDateInput = document.querySelector('#project-start-date');
    const endDateInput = document.querySelector('#project-end-date');
    const managerInput = document.querySelector('#project-manager');
    const clientInput = document.querySelector('#project-client');

    if (!nameInput || nameInput.value.trim() === "") {
        document.querySelector('#project-name-error').classList.remove('titanic');
    } else {
        document.querySelector('#project-name-error').classList.add('titanic');
    }

    if (!descriptionInput || descriptionInput.value.trim() === "") {
        document.querySelector('#project-description-error').classList.remove('titanic');
    } else {
        document.querySelector('#project-description-error').classList.add('titanic');
    }

    if (!includedHoursInput || includedHoursInput.value === "" || Number(includedHoursInput.value) < 0) {
        document.querySelector('#project-included-hours-error').classList.remove('titanic');
    } else {
        document.querySelector('#project-included-hours-error').classList.add('titanic');
    }

    if (!hourlyRateInput || hourlyRateInput.value === "" || Number(hourlyRateInput.value) < 0) {
        document.querySelector('#project-hourly-rate-error').classList.remove('titanic');
    } else {
        document.querySelector('#project-hourly-rate-error').classList.add('titanic');
    }

    if (!startDateInput || startDateInput.value === "") {
        document.querySelector('#project-start-date-error').classList.remove('titanic');
    } else {
        document.querySelector('#project-start-date-error').classList.add('titanic');
    }

    if (!endDateInput || endDateInput.value === "") {
        document.querySelector('#project-end-date-error').classList.remove('titanic');
    } else {
        document.querySelector('#project-end-date-error').classList.add('titanic');
    }

    if (!managerInput || managerInput.value === "") {
        document.querySelector('#project-manager-error').classList.remove('titanic');
    } else {
        document.querySelector('#project-manager-error').classList.add('titanic');
    }

    if (!clientInput || clientInput.value.trim() === "") {
        document.querySelector('#project-client-error').classList.remove('titanic');
    } else {
        document.querySelector('#project-client-error').classList.add('titanic');
    }
}

const newProjectForm = document.querySelector('#new-project-form');
if (newProjectForm) {
    newProjectForm.addEventListener('submit', function(event) {
        validateNewProjectForm(event);
    });
}

// Project Card Click Handling
const projectCards = document.querySelectorAll('.project-card');
projectCards.forEach(card => {
    card.addEventListener('click', function(event) {
        // prevent clicks on links inside the card from duplicating navigation
        if (event.target.closest('a')) return;

        const projectId = card.dataset.id || card.getAttribute('data-id');
        if (projectId) {
            window.location.href = `project_details.php?id=${encodeURIComponent(projectId)}`;
        } else {
            // fallback to title-based navigation
            const title = card.querySelector('.project-title')?.textContent.trim();
            window.location.href = `project_details.php?name=${encodeURIComponent(title)}`;
        }
    });
});

// Tickets Filter Functionality
function filterTickets() {
    const searchInput = document.querySelector('.ticket-search-input');
    const statusFilter = document.querySelector('.filter-select:nth-of-type(1)');
    const priorityFilter = document.querySelector('.filter-select:nth-of-type(2)');
    const typeFilter = document.querySelector('.filter-select:nth-of-type(3)');
    const rows = document.querySelectorAll('.tickets-table tbody tr');

    if (!searchInput || !statusFilter || !priorityFilter || !typeFilter) {
        return; // Exit if filters not found
    }

    const searchTerm = searchInput.value.toLowerCase();
    const selectedStatus = statusFilter.value.toLowerCase();
    const selectedPriority = priorityFilter.value.toLowerCase();
    const selectedType = typeFilter.value.toLowerCase();

    rows.forEach(row => {
        const title = row.cells[1].textContent.toLowerCase();
        const project = row.cells[2].textContent.toLowerCase();
        const status = row.cells[4].textContent.toLowerCase();
        const priority = row.cells[5].textContent.toLowerCase();
        const type = row.cells[6].textContent.toLowerCase();

        let showRow = true;

        // Search filter
        if (searchTerm && !title.includes(searchTerm) && !project.includes(searchTerm)) {
            showRow = false;
        }

        // Status filter
        if (selectedStatus && !status.includes(selectedStatus)) {
            showRow = false;
        }

        // Priority filter
        if (selectedPriority && !priority.includes(selectedPriority)) {
            showRow = false;
        }

        // Type filter
        if (selectedType && !type.includes(selectedType)) {
            showRow = false;
        }

        row.classList.toggle('titanic', !showRow);
    });
}


// Projects Filter Functionality
function filterProjects() {
    const searchInput = document.querySelector('.project-search-input');
    const rows = document.querySelectorAll('.project-card');

    if (!searchInput) {
        return; // Exit if filters not found
    }

    const searchTerm = searchInput.value.toLowerCase();

    rows.forEach(row => {
        const title = row.querySelector('.project-title').textContent.toLowerCase();
        const description = row.querySelector('.project-description').textContent.toLowerCase();
        
        let showRow = true;

        // Search filter
        if (searchTerm && !title.includes(searchTerm) && !description.includes(searchTerm)) {
            showRow = false;
        }

        row.classList.toggle('titanic', !showRow);
    });
}

// Attach filter listeners
const ticketsearchInput = document.querySelector('.ticket-search-input');
const projectsearchinput = document.querySelector('.project-search-input');
const filterSelects = document.querySelectorAll('.filter-select');

if (ticketsearchInput) {
    ticketsearchInput.addEventListener('input', filterTickets);
}

if (projectsearchinput) {
    projectsearchinput.addEventListener('input', filterProjects);
}

filterSelects.forEach(select => {
    select.addEventListener('change', filterTickets);
});

// Settings Menu Tab Switching
const settingsItems = document.querySelectorAll('.settings-item');
const settingsSections = document.querySelectorAll('.settings-section');

settingsItems.forEach(item => {
    item.addEventListener('click', function() {
        const sectionId = this.getAttribute('data-section');
        
        // Remove active class from all items and sections
        settingsItems.forEach(i => i.classList.remove('active'));
        settingsSections.forEach(s => s.classList.remove('active'));
        
        // Add active class to clicked item and corresponding section
        this.classList.add('active');
        document.getElementById(sectionId).classList.add('active');
    });
});