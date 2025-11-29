/**
 * Test Drive JavaScript
 */

/**
 * Show snackbar notification
 */
function showSnackbar(message, type = 'success') {
    const snackbar = document.getElementById('snackbar');
    snackbar.textContent = message;
    snackbar.className = 'snackbar snackbar-' + type + ' show';
    
    setTimeout(() => {
        snackbar.className = snackbar.className.replace('show', '');
    }, 5000);
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    // Check for pre-selected model from URL parameter
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
    
    // Handle form submission
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
        
        // Show success message
        showSnackbar(`Test drive scheduled for ${model} on ${formattedDate}. Our team will contact you shortly to confirm!`, 'success');
        
        // Reset form
        this.reset();
    });
});
