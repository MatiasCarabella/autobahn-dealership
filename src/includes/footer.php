    <!-- Footer -->
    <footer class="footer mt-auto py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-3 mb-md-0">
                    <h5 class="footer-brand">AUTOBAHN</h5>
                    <p class="footer-text">Premium luxury car dealership specializing in exotic and high-performance vehicles.</p>
                </div>
                <div class="col-md-4 mb-3 mb-md-0">
                    <h6 class="footer-heading">Quick Links</h6>
                    <ul class="footer-links">
                        <li><a href="/">Home</a></li>
                        <li><a href="/catalog">Catalog</a></li>
                        <li><a href="/test-drive">Test Drive</a></li>
                        <li><a href="/inventory">Inventory</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h6 class="footer-heading">Contact</h6>
                    <p class="footer-text mb-1">Email: info@autobahn.com</p>
                    <p class="footer-text mb-1">Phone: +1 (555) 123-4567</p>
                    <p class="footer-text">Hours: Mon-Sat 9AM-6PM</p>
                </div>
            </div>
            <hr class="footer-divider">
            <div class="row">
                <div class="col-12 text-center">
                    <p class="footer-copyright">&copy; <?php echo date('Y'); ?> Autobahn. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <?php if (isset($additionalJS)): ?>
        <?php foreach ($additionalJS as $js): ?>
            <script src="<?php echo $js; ?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>
</body>
</html>
