// Project Card Click Handling
const projectCards = document.querySelectorAll('.project-card');
projectCards.forEach(card => {
    card.addEventListener('click', function(event) {
        // prevent clicks on links inside the card from duplicating navigation
        if (event.target.closest('a')) return;

        const url = card.dataset.url;
        if (url) window.location.href = url;
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

        let hideRow = false;

        // Search filter
        if (searchTerm && !title.includes(searchTerm) && !project.includes(searchTerm)) {
            hideRow = true;
        }

        // Status filter
        if (selectedStatus && !status.includes(selectedStatus)) {
            hideRow = true;
        }

        // Priority filter
        if (selectedPriority && !priority.includes(selectedPriority)) {
            hideRow = true;
        }

        // Type filter
        if (selectedType && !type.includes(selectedType)) {
            hideRow = true;
        }

        row.classList.toggle('titanic', hideRow);
    });
}

// Users Filter Functionality
function filterUsers() {
    const searchInput = document.querySelector('.users-search-input');
    const roleFilter = document.querySelector('.users-select');
    const rows = document.querySelectorAll('.tickets-table tbody tr');

    if (!searchInput || !roleFilter) {
        return; // Exit if filters not found
    }

    const searchTerm = searchInput.value.toLowerCase();
    const selectedRole = roleFilter.value.toLowerCase();

    rows.forEach(row => {
        const name = row.cells[0].textContent.toLowerCase();
        const role = row.cells[1].textContent.toLowerCase();

        let hideRow = false;

        // Search filter
        if (searchTerm && !name.includes(searchTerm)) {
            hideRow = true;
        }

        // Role filter
        if (selectedRole && !role.includes(selectedRole)) {
            hideRow = true;
        }

        row.classList.toggle('titanic', hideRow);
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
        
        let hideRow = false;


        // Search filter
        if (searchTerm && !title.includes(searchTerm) && !description.includes(searchTerm)) {
            hideRow = true;
        }

        row.classList.toggle('titanic', hideRow);
    });
}

// Attach filter listeners
const ticketsearchInput = document.querySelector('.ticket-search-input');
const projectsearchinput = document.querySelector('.project-search-input');
const userssearchinput = document.querySelector('.users-search-input');
const filterSelects = document.querySelectorAll('.filter-select');
const usersSelects = document.querySelectorAll('.users-select');

if (ticketsearchInput) {
    ticketsearchInput.addEventListener('input', filterTickets);
}

function Boo(){
    console.log("boo");
}

if (projectsearchinput) {
    projectsearchinput.addEventListener('input', filterProjects);
}

if (userssearchinput) {
    userssearchinput.addEventListener('input', filterUsers);
}

if (usersSelects) {
    usersSelects.forEach(select => {
        select.addEventListener('change', filterUsers);
    });
}

filterSelects.forEach(select => {
    select.addEventListener('change', filterTickets);
});


document.addEventListener('DOMContentLoaded', () => {
    const ticketPage = document.querySelector('[data-ticket-page]');
    if (!ticketPage) {
        return;
    }

    const modal = ticketPage.querySelector('[data-ticket-modal]');
    const openButtons = ticketPage.querySelectorAll('[data-open-ticket-modal]');
    const closeButtons = ticketPage.querySelectorAll('[data-close-ticket-modal]');
    const openOnLoad = ticketPage.dataset.openOnLoad === 'true';

    if (!modal) {
        return;
    }

    const openModal = () => {
        if (typeof modal.showModal === 'function') {
            if (!modal.open) {
                modal.showModal();
            }
        } else {
            modal.style.display = 'block';
            modal.setAttribute('open', '');
        }
    };

    const closeModal = () => {
        if (typeof modal.close === 'function') {
            if (modal.open) {
                modal.close();
            }
        } else {
            modal.style.display = 'none';
            modal.removeAttribute('open');
        }
    };

    openButtons.forEach((button) => {
        button.addEventListener('click', openModal);
    });

    closeButtons.forEach((button) => {
        button.addEventListener('click', closeModal);
    });

    modal.addEventListener('click', (event) => {
        const rect = modal.getBoundingClientRect();
        const clickedOutside =
            event.clientX < rect.left ||
            event.clientX > rect.right ||
            event.clientY < rect.top ||
            event.clientY > rect.bottom;

        if (clickedOutside) {
            closeModal();
        }
    });

    if (openOnLoad) {
        openModal();
    }

    const ticketForm = document.querySelector('[data-ticket-api-form]');
    const ticketSubmitButton = ticketForm?.querySelector('[data-ticket-submit-button]');

    if (ticketForm && ticketSubmitButton) {
        const requiredFields = Array.from(ticketForm.querySelectorAll('input[required], textarea[required], select[required]'));

        const validateTicketForm = () => {
            const isValid = requiredFields.every((field) => field.value.trim() !== '');
            ticketSubmitButton.disabled = !isValid;
        };

        requiredFields.forEach((field) => {
            field.addEventListener('input', validateTicketForm);
            field.addEventListener('change', validateTicketForm);
        });

        validateTicketForm();
    }
});