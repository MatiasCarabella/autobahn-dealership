/**
 * Catalog JavaScript
 */

let carDetailsModal;

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    carDetailsModal = new bootstrap.Modal(document.getElementById('carDetailsModal'));
});

/**
 * Show car details in modal
 */
function showCarDetails(name, engine, horsepower, torque, acceleration, topSpeed, price, offer) {
    document.getElementById('carDetailsModalLabel').textContent = name;
    document.getElementById('detailEngine').textContent = engine;
    document.getElementById('detailHorsepower').textContent = horsepower;
    document.getElementById('detailTorque').textContent = torque;
    document.getElementById('detailAcceleration').textContent = acceleration;
    document.getElementById('detailTopSpeed').textContent = topSpeed;
    document.getElementById('detailPrice').textContent = price;
    document.getElementById('detailOffer').textContent = offer;
    
    // Update the Schedule Test Drive button link with the car model
    const scheduleBtn = document.getElementById('scheduleTestDriveBtn');
    scheduleBtn.href = '/test-drive.php?model=' + encodeURIComponent(name);
    
    carDetailsModal.show();
}
