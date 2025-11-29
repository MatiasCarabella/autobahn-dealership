<?php
require_once 'config/database.php';

$pageTitle = 'Inventory - Autobahn';
$currentPage = 'inventory';
$additionalJS = ['https://code.jquery.com/jquery-3.7.1.min.js'];

// Create database connection
$database = new Database();
$db = $database->getMysqliConnection();

// Handle form submission (create, update or delete records)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Determine the action requested by the user
    if ($_POST['action'] == 'delete') {
        $id = (int)$_POST['vehicleId'];
        $sql = "DELETE FROM inventory WHERE id = $id";
        $successMessage = "Vehicle deleted successfully!";
    } else {
        // Only process form fields for add/update actions
        $brand = $db->real_escape_string($_POST['brand'] ?? '');
        $model = $db->real_escape_string($_POST['model'] ?? '');
        $year = $db->real_escape_string($_POST['year'] ?? '');
        $price = $db->real_escape_string($_POST['price'] ?? '');
        $condition = $db->real_escape_string($_POST['condition'] ?? '');
        $availability = $db->real_escape_string($_POST['availability'] ?? '');

        if ($_POST['action'] == 'add') {
            $sql = "INSERT INTO inventory (brand, model, year, price, `condition`, availability)
                    VALUES ('$brand', '$model', '$year', '$price', '$condition', '$availability')";
            $successMessage = "Vehicle added successfully!";
        } else {
            $id = (int)$_POST['vehicleId'];
            $sql = "UPDATE inventory 
                    SET brand='$brand', model='$model', year='$year', 
                        price='$price', `condition`='$condition', availability='$availability'
                    WHERE id=$id";
            $successMessage = "Vehicle updated successfully!";
        }
    }

    // Execute query and handle result
    if ($db->query($sql) === TRUE) {
        $alertMessage = $successMessage;
        $alertType = 'success';
    } else {
        $alertMessage = "Error: " . $db->error;
        $alertType = 'error';
    }
}

// Query all existing records in 'inventory' table
$sql = "SELECT * FROM inventory ORDER BY id DESC";
$result = $db->query($sql);

include 'includes/header.php';
include 'includes/navbar.php';
?>

<div class="container mt-5">
    <h1 class="text-center mb-4">Inventory</h1>

    <!-- Snackbar container -->
    <div id="snackbar" class="snackbar"></div>

    <!-- Search and Add buttons with inline search -->
    <div class="d-flex justify-content-center align-items-center gap-3 mb-4">
        <button id="searchButton" class="btn btn-gold" onclick="toggleSearch()">Search</button>
        <div id="searchForm" class="search-inline d-none">
            <input type="text" class="form-control" id="searchInput" placeholder="Search by Brand, Model, or Year...">
        </div>
        <button id="toggleButton" class="btn btn-gold" onclick="openModal()">Add</button>
    </div>

    <!-- Modal for Add/Edit Vehicle -->
    <div class="modal fade" id="vehicleModal" tabindex="-1" aria-labelledby="vehicleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="vehicleModalLabel">Add Vehicle</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="/inventory.php" id="vehicleForm">
                        <input type="hidden" name="action" value="add" id="formAction">
                        <input type="hidden" name="vehicleId" id="vehicleId">
                        
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="brand" class="form-label">Brand</label>
                                <input type="text" class="form-control" id="brand" name="brand" required>
                            </div>
                            <div class="col-md-4">
                                <label for="model" class="form-label">Model</label>
                                <input type="text" class="form-control" id="model" name="model" required>
                            </div>
                            <div class="col-md-4">
                                <label for="year" class="form-label">Year</label>
                                <input type="number" class="form-control" id="year" name="year" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="price" class="form-label">Price (USD)</label>
                                <input type="text" class="form-control" id="price" name="price" required>
                            </div>
                            <div class="col-md-4">
                                <label for="condition" class="form-label">Condition</label>
                                <select class="form-select form-control" id="condition" name="condition" required>
                                    <option value="">Select condition...</option>
                                    <option value="new">New</option>
                                    <option value="used">Used</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="availability" class="form-label">Availability</label>
                                <select class="form-select form-control" id="availability" name="availability" required>
                                    <option value="">Select availability...</option>
                                    <option value="available">Available</option>
                                    <option value="unavailable">Unavailable</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" form="vehicleForm" class="btn btn-gold">Save Vehicle</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Table to display existing vehicles -->
    <div class="table-container">
        <table class="table table-dark table-striped" id="inventoryTable">
        <thead>
            <tr>
                <th class="sortable" onclick="sortTable(0)">Brand <span class="sort-icon">⇅</span></th>
                <th class="sortable" onclick="sortTable(1)">Model <span class="sort-icon">⇅</span></th>
                <th class="sortable" onclick="sortTable(2)">Year <span class="sort-icon">⇅</span></th>
                <th class="sortable" onclick="sortTable(3)">Price (USD) <span class="sort-icon">⇅</span></th>
                <th class="sortable" onclick="sortTable(4)">Condition <span class="sort-icon">⇅</span></th>
                <th class="sortable" onclick="sortTable(5)">Availability <span class="sort-icon">⇅</span></th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0) : ?>
                <?php while ($row = $result->fetch_assoc()) : ?>
                    <tr>
                        <td><?= htmlspecialchars($row['brand']) ?></td>
                        <td><?= htmlspecialchars($row['model']) ?></td>
                        <td><?= htmlspecialchars($row['year']) ?></td>
                        <td>$ <?= number_format($row['price'], 2) ?></td>
                        <td><?= ucfirst(htmlspecialchars($row['condition'])) ?></td>
                        <td><?= ucfirst(htmlspecialchars($row['availability'])) ?></td>
                        <td>
                            <button class="btn btn-gold btn-sm" onclick='editVehicle(<?= json_encode($row) ?>)'>Edit</button>
                            <form method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this vehicle?')">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="vehicleId" value="<?= $row['id'] ?>">
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else : ?>
                <tr>
                    <td colspan="7" class="text-center">No vehicles in inventory</td>
                </tr>
            <?php endif; ?>
        </tbody>
        </table>
    </div>
</div>

<script>
    // Bootstrap modal instance
    let vehicleModal;
    
    document.addEventListener('DOMContentLoaded', function() {
        vehicleModal = new bootstrap.Modal(document.getElementById('vehicleModal'));
        
        // Show snackbar if there's a message from PHP
        <?php if (isset($alertMessage) && isset($alertType)): ?>
            showSnackbar('<?= addslashes($alertMessage) ?>', '<?= $alertType ?>');
        <?php endif; ?>
    });

    function showSnackbar(message, type = 'success') {
        const snackbar = document.getElementById('snackbar');
        snackbar.textContent = message;
        snackbar.className = 'snackbar snackbar-' + type + ' show';
        
        // Auto-hide after 4 seconds
        setTimeout(() => {
            snackbar.className = snackbar.className.replace('show', '');
        }, 4000);
    }

    function openModal() {
        // Reset form for adding new vehicle
        document.getElementById('vehicleForm').reset();
        document.getElementById('formAction').value = 'add';
        document.getElementById('vehicleId').value = '';
        document.getElementById('vehicleModalLabel').textContent = 'Add Vehicle';
        vehicleModal.show();
    }

    function editVehicle(vehicle) {
        // Populate form with vehicle data
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
            // Show all rows when opening search
            const rows = document.querySelectorAll('#inventoryTable tbody tr');
            rows.forEach(row => row.style.display = '');
        } else {
            searchForm.classList.add('d-none');
            searchButton.textContent = 'Search';
            if (searchInput) searchInput.value = '';
            // Show all rows when closing search
            const rows = document.querySelectorAll('#inventoryTable tbody tr');
            rows.forEach(row => row.style.display = '');
        }
    }

    // Search/Filter functionality - using vanilla JavaScript
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        
        if (searchInput) {
            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                const table = document.getElementById('inventoryTable');
                const rows = table.querySelectorAll('tbody tr');
                
                rows.forEach(function(row) {
                    const brand = row.cells[0].textContent.toLowerCase();
                    const model = row.cells[1].textContent.toLowerCase();
                    const year = row.cells[2].textContent.toLowerCase();
                    
                    if (brand.includes(searchTerm) || model.includes(searchTerm) || year.includes(searchTerm)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        }
    });

    // Table sorting functionality
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
</script>

<?php 
$db->close();
include 'includes/footer.php'; 
?>
