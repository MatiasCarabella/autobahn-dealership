<?php
$pageTitle = 'Schedule Test Drive - Autobahn';
$currentPage = 'test-drive';
include 'includes/header.php';
include 'includes/navbar.php';
?>

<div class="container form-container">
    <h1 class="text-center mb-4">Test Drive</h1>
    
    <!-- Snackbar container -->
    <div id="snackbar" class="snackbar"></div>
    
    <div class="col-md-6 offset-md-3">
        <div class="card no-hover p-4">
            <div class="card-body">
                <h4 class="card-title text-center mb-4">Schedule Your Test Drive Today</h4>
                <form id="testDriveForm" method="POST" action="/test-drive.php">
                    <div class="mb-3">
                        <label for="model" class="form-label">Model</label>
                        <select class="form-select form-control" id="model" name="model" required>
                            <option value="">Select a model...</option>
                            <option>Ferrari 488 GTB</option>
                            <option>Porsche 911 Carrera</option>
                            <option>Lamborghini Huracán</option>
                            <option>Aston Martin Vantage</option>
                            <option>McLaren 720S</option>
                            <option>Bugatti Chiron</option>
                            <option>Rolls-Royce Phantom</option>
                            <option>BMW M8 Competition</option>
                            <option>Mercedes-Benz AMG GT</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="date" class="form-label">Date</label>
                        <input type="date" class="form-control" id="date" name="date" required>
                    </div>
                    <button type="submit" class="btn btn-gold w-100">Schedule Test Drive</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function showSnackbar(message, type = 'success') {
        const snackbar = document.getElementById('snackbar');
        snackbar.textContent = message;
        snackbar.className = 'snackbar snackbar-' + type + ' show';
        
        setTimeout(() => {
            snackbar.className = snackbar.className.replace('show', '');
        }, 5000);
    }

    // Check for pre-selected model from URL parameter
    document.addEventListener('DOMContentLoaded', function() {
        const urlParams = new URLSearchParams(window.location.search);
        const preSelectedModel = urlParams.get('model');
        
        if (preSelectedModel) {
            const modelSelect = document.getElementById('model');
            // Try to find and select the matching option
            for (let option of modelSelect.options) {
                if (option.value === preSelectedModel || option.text === preSelectedModel) {
                    option.selected = true;
                    break;
                }
            }
        }

        // Make date input open picker on click
        const dateInput = document.getElementById('date');
        dateInput.addEventListener('click', function() {
            this.showPicker();
        });
    });

    document.getElementById('testDriveForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const model = document.getElementById('model').value;
        const date = document.getElementById('date').value;
        
        // Format the date nicely
        const dateObj = new Date(date);
        const formattedDate = dateObj.toLocaleDateString('en-US', { 
            weekday: 'long', 
            year: 'numeric', 
            month: 'long', 
            day: 'numeric' 
        });
        
        // Show success message with longer duration for longer text
        showSnackbar(`Test drive scheduled for ${model} on ${formattedDate}. Our team will contact you shortly to confirm!`, 'success');
        
        // Reset form
        this.reset();
    });
</script>

<?php include 'includes/footer.php'; ?>
