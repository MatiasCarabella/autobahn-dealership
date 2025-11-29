<?php
$pageTitle = 'Autobahn - Luxury Car Dealership';
$currentPage = 'home';
include 'includes/header.php';
include 'includes/navbar.php';
?>

<!-- Hero Section -->
<div class="hero-section">
    <div class="container">
        <div class="hero-content">
            <h1 class="hero-title">Autobahn</h1>
            <p class="hero-subtitle">Discover the world's most prestigious automobiles</p>
            <div class="hero-buttons">
                <a href="/catalog" class="btn btn-gold btn-lg">View Collection</a>
                <a href="/test-drive" class="btn btn-outline-gold btn-lg">Schedule Test Drive</a>
            </div>
        </div>
    </div>
</div>

<!-- Features Section -->
<div class="container my-5">
    <div class="row g-4">
        <div class="col-md-4">
            <div class="feature-card">
                <div class="feature-icon">🏎️</div>
                <h3 class="feature-title">Premium Selection</h3>
                <p class="feature-text">Curated collection of the world's finest luxury and exotic vehicles</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="feature-card">
                <div class="feature-icon">✨</div>
                <h3 class="feature-title">Exclusive Benefits</h3>
                <p class="feature-text">VIP access, factory tours, and track experiences with every purchase</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="feature-card">
                <div class="feature-icon">🔒</div>
                <h3 class="feature-title">Trusted Service</h3>
                <p class="feature-text">Professional expertise and personalized attention for every client</p>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
