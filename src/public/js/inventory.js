/**
 * Inventory Management JavaScript
 */

// Bootstrap modal instance
let vehicleModal;

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    vehicleModal = new bootstrap.Modal(document.getElementById('vehicleModal'));
    
    // Initialize search functionality
    initializeSearch();
});

/**
 * Show snackbar notification
 */
function showSnackbar(message, type = 'success') {
    const snackbar = document.getElementById('snackbar');
    snackbar.textContent = message;
    snackbar.className = 'snackbar snackbar-' + type + ' show';
    
    // Auto-hide after 4 seconds
    setTimeout(() => {
        snackbar.className = snackbar.className.replace('show', '');
    }, 4000);
}

/**
 * Open modal for adding new vehicle
 */
function openModal() {
    document.getElementById('vehicleForm').reset();
    document.getElementById('formAction').value = 'add';
    document.getElementById('vehicleId').value = '';
    document.getElementById('vehicleModalLabel').textContent = 'Add Vehicle';
    vehicleModal.show();
}

/**
 * Open modal for editing existing vehicle
 */
function editVehicle(vehicle) {
    document.getElementById('formAction').value = 'update';
    document.getElementById('vehicleId').value = vehicle.id;
    document.getElementById('brand').value = vehicle.brand;
    document.getElementById('model').value = vehicle.model;
    document.getElementById('year').value = vehicle.year;
    document.getElementById('price').value = vehicle.price;
    document.getElementById('condition').value = vehicle.condition;
    document.getElementById('availability').value = vehicle.availability;
    document.getElementById('vehicleModalLabel').textContent = 'Edit Vehicle';
    vehicleModal.show();
}

/**
 * Toggle search form visibility
 */
function toggleSearch() {
    const searchForm = document.getElementById('searchForm');
    const searchButton = document.getElementById('searchButton');
    const searchInput = document.getElementById('searchInput');
    
    if (searchForm.classList.contains('d-none')) {
        searchForm.classList.remove('d-none');
        searchButton.textContent = 'Cancel';
        if (searchInput) {
            searchInput.value = '';
            setTimeout(() => searchInput.focus(), 100);
        }
        showAllRows();
    } else {
        searchForm.classList.add('d-none');
        searchButton.textContent = 'Search';
        if (searchInput) searchInput.value = '';
        showAllRows();
    }
}

/**
 * Show all table rows
 */
function showAllRows() {
    const rows = document.querySelectorAll('#inventoryTable tbody tr');
    rows.forEach(row => row.style.display = '');
}

/**
 * Initialize search/filter functionality
 */
function initializeSearch() {
    const searchInput = document.getElementById('searchInput');
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const rows = document.querySelectorAll('#inventoryTable tbody tr');
            
            rows.forEach(function(row) {
                if (row.cells.length < 3) return; // Skip empty state row
                
                const brand = row.cells[0].textContent.toLowerCase();
                const model = row.cells[1].textContent.toLowerCase();
                const year = row.cells[2].textContent.toLowerCase();
                
                row.style.display = (brand.includes(searchTerm) || model.includes(searchTerm) || year.includes(searchTerm)) ? '' : 'none';
            });
        });
    }
}

/**
 * Sort table by column
 */
let sortDirection = {};

function sortTable(columnIndex) {
    const table = document.getElementById('inventoryTable');
    const tbody = table.querySelector('tbody');
    const rows = Array.from(tbody.querySelectorAll('tr'));
    
    // Initialize sort direction for this column
    if (!sortDirection[columnIndex]) {
        sortDirection[columnIndex] = 'asc';
    }
    
    // Toggle sort direction
    const isAscending = sortDirection[columnIndex] === 'asc';
    sortDirection[columnIndex] = isAscending ? 'desc' : 'asc';
    
    rows.sort((a, b) => {
        let aValue = a.cells[columnIndex].textContent.trim();
        let bValue = b.cells[columnIndex].textContent.trim();
        
        // Handle price column (remove $ and commas)
        if (columnIndex === 3) {
            aValue = parseFloat(aValue.replace(/[$,]/g, ''));
            bValue = parseFloat(bValue.replace(/[$,]/g, ''));
        }
        // Handle year column
        else if (columnIndex === 2) {
            aValue = parseInt(aValue);
            bValue = parseInt(bValue);
        }
        
        if (typeof aValue === 'number' && typeof bValue === 'number') {
            return isAscending ? aValue - bValue : bValue - aValue;
        } else {
            return isAscending 
                ? aValue.localeCompare(bValue)
                : bValue.localeCompare(aValue);
        }
    });
    
    // Re-append sorted rows
    rows.forEach(row => tbody.appendChild(row));
}
