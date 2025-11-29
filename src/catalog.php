<?php
$pageTitle = 'Catalog - Autobahn';
$currentPage = 'catalog';
$additionalJS = ['/js/catalog.js'];
include 'includes/header.php';
include 'includes/navbar.php';
?>

<div class="container mt-5 mb-5">
    <h1 class="text-center mb-5">Catalog</h1>
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card">
                <div class="card-img-container">
                    <img src="/images/Ferrari-488-GTB.jpg" class="card-img-top" alt="Ferrari 488 GTB">
                </div>
                <div class="card-body">
                    <h5 class="card-title">Ferrari 488 GTB</h5>
                    <p class="card-text">Track driving experience included with purchase.</p>
                    <button class="btn btn-gold" onclick="showCarDetails('Ferrari 488 GTB', '3.9L Twin-Turbo V8', '661 hp @ 8,000 rpm', '561 lb-ft @ 3,000 rpm', '3.0 seconds', '205 mph', '$280,000', 'Track driving experience included with purchase.')">More Details</button>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-img-container">
                    <img src="/images/Porsche-911-Carrera.jpg" class="card-img-top" alt="Porsche 911 Carrera">
                </div>
                <div class="card-body">
                    <h5 class="card-title">Porsche 911 Carrera</h5>
                    <p class="card-text">Exclusive customization with Porsche Exclusive Manufaktur.</p>
                    <button class="btn btn-gold" onclick="showCarDetails('Porsche 911 Carrera', '3.0L Twin-Turbo Flat-6', '379 hp @ 6,500 rpm', '331 lb-ft @ 1,700 rpm', '4.0 seconds', '182 mph', '$115,000', 'Exclusive customization with Porsche Exclusive Manufaktur.')">More Details</button>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-img-container">
                    <img src="/images/Lamborghini-Huracán-Performante.jpg" class="card-img-top" alt="Lamborghini Huracán">
                </div>
                <div class="card-body">
                    <h5 class="card-title">Lamborghini Huracán</h5>
                    <p class="card-text">VIP access to Lamborghini Squadra Corse program.</p>
                    <button class="btn btn-gold" onclick="showCarDetails('Lamborghini Huracán Performante', '5.2L V10', '640 hp @ 8,000 rpm', '443 lb-ft @ 6,500 rpm', '2.9 seconds', '202 mph', '$310,000', 'VIP access to Lamborghini Squadra Corse program.')">More Details</button>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-img-container">
                    <img src="/images/Aston-Martin-Vantage.png" class="card-img-top" alt="Aston Martin Vantage">
                </div>
                <div class="card-body">
                    <h5 class="card-title">Aston Martin Vantage</h5>
                    <p class="card-text">Exclusive tour of Gaydon factory with your purchase.</p>
                    <button class="btn btn-gold" onclick="showCarDetails('Aston Martin Vantage', '4.0L Twin-Turbo V8', '503 hp @ 6,000 rpm', '505 lb-ft @ 2,000 rpm', '3.5 seconds', '195 mph', '$145,000', 'Exclusive tour of Gaydon factory with your purchase.')">More Details</button>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-img-container">
                    <img src="/images/McLaren-720S.jpeg" class="card-img-top" alt="McLaren 720S">
                </div>
                <div class="card-body">
                    <h5 class="card-title">McLaren 720S</h5>
                    <p class="card-text">Private configuration session with McLaren designer.</p>
                    <button class="btn btn-gold" onclick="showCarDetails('McLaren 720S', '4.0L Twin-Turbo V8', '710 hp @ 7,500 rpm', '568 lb-ft @ 5,500 rpm', '2.8 seconds', '212 mph', '$300,000', 'Private configuration session with McLaren designer.')">More Details</button>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-img-container">
                    <img src="/images/Bugatti-Chiron-Sport.png" class="card-img-top" alt="Bugatti Chiron">
                </div>
                <div class="card-body">
                    <h5 class="card-title">Bugatti Chiron</h5>
                    <p class="card-text">Invitation to exclusive annual Bugatti owners event.</p>
                    <button class="btn btn-gold" onclick="showCarDetails('Bugatti Chiron Sport', '8.0L Quad-Turbo W16', '1,479 hp @ 6,700 rpm', '1,180 lb-ft @ 2,000 rpm', '2.4 seconds', '261 mph', '$3,600,000', 'Invitation to exclusive annual Bugatti owners event.')">More Details</button>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-img-container">
                    <img src="/images/Rolls-Royce-Phantom.png" class="card-img-top" alt="Rolls-Royce Phantom">
                </div>
                <div class="card-body">
                    <h5 class="card-title">Rolls-Royce Phantom</h5>
                    <p class="card-text">One month luxury chauffeur experience with your purchase.</p>
                    <button class="btn btn-gold" onclick="showCarDetails('Rolls-Royce Phantom', '6.75L Twin-Turbo V12', '563 hp @ 5,000 rpm', '664 lb-ft @ 1,700 rpm', '5.3 seconds', '155 mph', '$460,000', 'One month luxury chauffeur experience with your purchase.')">More Details</button>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-img-container">
                    <img src="/images/BMW-M8-Competition.jpg" class="card-img-top" alt="BMW M8 Competition">
                </div>
                <div class="card-body">
                    <h5 class="card-title">BMW M8 Competition</h5>
                    <p class="card-text">BMW M driving course at Nürburgring included.</p>
                    <button class="btn btn-gold" onclick="showCarDetails('BMW M8 Competition', '4.4L Twin-Turbo V8', '617 hp @ 6,000 rpm', '553 lb-ft @ 1,800 rpm', '3.0 seconds', '190 mph', '$135,000', 'BMW M driving course at Nürburgring included.')">More Details</button>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-img-container">
                    <img src="/images/Mercedes-Benz-AMG-GT.jpeg" class="card-img-top" alt="Mercedes-Benz AMG GT">
                </div>
                <div class="card-body">
                    <h5 class="card-title">Mercedes-Benz AMG GT</h5>
                    <p class="card-text">Exclusive one-year membership to AMG Private Lounge.</p>
                    <button class="btn btn-gold" onclick="showCarDetails('Mercedes-Benz AMG GT', '4.0L Twin-Turbo V8', '523 hp @ 6,250 rpm', '494 lb-ft @ 1,900 rpm', '3.7 seconds', '193 mph', '$120,000', 'Exclusive one-year membership to AMG Private Lounge.')">More Details</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Car Details Modal -->
<div class="modal fade" id="carDetailsModal" tabindex="-1" aria-labelledby="carDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="carDetailsModalLabel">Vehicle Specifications</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <p class="mb-2"><strong class="text-gold">Engine:</strong> <span id="detailEngine"></span></p>
                        <p class="mb-2"><strong class="text-gold">Horsepower:</strong> <span id="detailHorsepower"></span></p>
                        <p class="mb-2"><strong class="text-gold">Torque:</strong> <span id="detailTorque"></span></p>
                    </div>
                    <div class="col-md-6">
                        <p class="mb-2"><strong class="text-gold">0-60 mph:</strong> <span id="detailAcceleration"></span></p>
                        <p class="mb-2"><strong class="text-gold">Top Speed:</strong> <span id="detailTopSpeed"></span></p>
                        <p class="mb-2"><strong class="text-gold">Price:</strong> <span id="detailPrice" class="text-gold"></span></p>
                    </div>
                </div>
                <hr style="border-color: var(--bg-medium);">
                <p class="mb-0"><strong class="text-gold">Exclusive Offer:</strong> <span id="detailOffer"></span></p>
            </div>
            <div class="modal-footer">
                <a href="#" id="scheduleTestDriveBtn" class="btn btn-gold">Schedule Test Drive</a>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<?php include 'includes/footer.php'; ?>
