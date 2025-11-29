<?php
require_once 'config/database.php';

$pageTitle = 'Inventory - Autobahn';
$currentPage = 'inventory';
$additionalJS = ['/js/inventory.js'];

// Create database connection
$database = new Database();
$db = $database->getMysqliConnection();

// Handle form submission (create, update or delete records)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    
    try {
        if ($action === 'delete') {
            // Use prepared statement for DELETE
            $stmt = $db->prepare("DELETE FROM inventory WHERE id = ?");
            $vehicleId = (int)$_POST['vehicleId'];
            $stmt->bind_param("i", $vehicleId);
            $stmt->execute();
            $stmt->close();
            
            $alertMessage = "Vehicle deleted successfully!";
            $alertType = 'success';
            
        } elseif ($action === 'add' || $action === 'update') {
            // Validate inputs
            $brand = trim($_POST['brand'] ?? '');
            $model = trim($_POST['model'] ?? '');
            $year = (int)($_POST['year'] ?? 0);
            $price = filter_var($_POST['price'] ?? 0, FILTER_VALIDATE_FLOAT);
            $condition = $_POST['condition'] ?? '';
            $availability = $_POST['availability'] ?? '';
            
            // Validation
            if (empty($brand) || empty($model) || $year < 1900 || $year > 2100 || $price === false || $price < 0) {
                throw new Exception("Invalid input data");
            }
            
            if (!in_array($condition, ['new', 'used'])) {
                throw new Exception("Invalid condition value");
            }
            
            if (!in_array($availability, ['available', 'unavailable'])) {
                throw new Exception("Invalid availability value");
            }
            
            if ($action === 'add') {
                $stmt = $db->prepare("INSERT INTO inventory (brand, model, year, price, `condition`, availability) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("ssidss", $brand, $model, $year, $price, $condition, $availability);
                $successMessage = "Vehicle added successfully!";
            } else {
                $vehicleId = (int)$_POST['vehicleId'];
                $stmt = $db->prepare("UPDATE inventory SET brand=?, model=?, year=?, price=?, `condition`=?, availability=? WHERE id=?");
                $stmt->bind_param("ssidssi", $brand, $model, $year, $price, $condition, $availability, $vehicleId);
                $successMessage = "Vehicle updated successfully!";
            }
            
            $stmt->execute();
            $stmt->close();
            
            $alertMessage = $successMessage;
            $alertType = 'success';
        }
    } catch (Exception $e) {
        error_log("Inventory error: " . $e->getMessage());
        $alertMessage = "An error occurred. Please try again.";
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
                                <input type="number" class="form-control" id="year" name="year" min="1900" max="2100" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="price" class="form-label">Price (USD)</label>
                                <input type="number" class="form-control" id="price" name="price" min="0" step="0.01" required>
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
        <table class="table table-dark table-striped" id="inventoryTable" style="--bs-table-bg: transparent; --bs-table-striped-bg: transparent;">
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


<?php if (isset($alertMessage) && isset($alertType)): ?>
<script>
    // Show snackbar on page load if there's a message
    document.addEventListener('DOMContentLoaded', function() {
        showSnackbar('<?= addslashes($alertMessage) ?>', '<?= $alertType ?>');
    });
</script>
<?php endif; ?>

<?php 
$db->close();
include 'includes/footer.php'; 
?>
