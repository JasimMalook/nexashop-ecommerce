</main>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <div class="footer-brand">
                        <h5 class="text-white mb-3 d-flex align-items-center">
                            <img src="assets/images/logo.svg" alt="ShopSphere Logo" width="32" height="32" class="me-2" style="filter: brightness(0) invert(1);">
                            ShopSphere
                        </h5>
                        <p class="text-muted mb-0">Your trusted online shopping destination for quality products and great deals.</p>
                    </div>
                </div>
                <div class="col-lg-2 mb-4 mb-lg-0">
                    <h6 class="text-white mb-3">Quick Links</h6>
                    <ul class="list-unstyled footer-links">
                        <li><a href="index.php">
                            <i class="fas fa-home me-2"></i>Home
                        </a></li>
                        <li><a href="shop.php">
                            <i class="fas fa-shopping-bag me-2"></i>Shop
                        </a></li>
                        <li><a href="cart.php">
                            <i class="fas fa-shopping-cart me-2"></i>Cart
                        </a></li>
                        <?php if (isLoggedIn()): ?>
                            <li><a href="dashboard.php">
                                <i class="fas fa-user me-2"></i>My Account
                            </a></li>
                        <?php endif; ?>
                    </ul>
                </div>
                <div class="col-lg-3 mb-4 mb-lg-0">
                    <h6 class="text-white mb-3">Customer Service</h6>
                    <ul class="list-unstyled footer-links">
                        <li><a href="contact.php">
                            <i class="fas fa-envelope me-2"></i>Contact Us
                        </a></li>
                        <li><a href="shipping.php">
                            <i class="fas fa-truck me-2"></i>Shipping Info
                        </a></li>
                        <li><a href="returns.php">
                            <i class="fas fa-undo me-2"></i>Returns
                        </a></li>
                        <li><a href="faq.php">
                            <i class="fas fa-question-circle me-2"></i>FAQ
                        </a></li>
                    </ul>
                </div>
                <div class="col-lg-3 mb-4 mb-lg-0">
                    <h6 class="text-white mb-3">Connect With Us</h6>
                    <p class="text-muted mb-3">Follow us on social media for updates and exclusive offers.</p>
                    <div class="social-icons">
                        <a href="#" class="social-icon">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>
            </div>
            <hr class="my-4 border-secondary">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="text-muted mb-0 mb-md-0">
                        &copy; <?php echo date('Y'); ?> ShopSphere. All rights reserved.
                    </p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="text-muted mb-0">
                        Made with <i class="fas fa-heart text-danger"></i> for great shopping experience
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <!-- Custom JS -->
    <script src="assets/js/script.js"></script>
    
    <!-- Cart Update Script -->
    <script>
    // Update cart count dynamically
    function updateCartCount(count) {
        const cartCountElements = document.querySelectorAll('.cart-count');
        cartCountElements.forEach(element => {
            if (count > 0) {
                element.textContent = count;
                element.style.display = 'inline-block';
                element.className = 'badge bg-danger rounded-pill cart-count';
            } else {
                element.style.display = 'none';
            }
        });
    }

    // AJAX cart functions
    function addToCart(productId, quantity = 1) {
        $.ajax({
            url: 'cart/add_to_cart.php',
            method: 'POST',
            data: {
                product_id: productId,
                quantity: quantity
            },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    updateCartCount(response.cart_count);
                    showAlert(response.message, 'success');
                } else {
                    showAlert(response.message, 'danger');
                }
            },
            error: function() {
                showAlert('Error adding product to cart', 'danger');
            }
        });
    }

    function updateCart(productId, quantity, action = 'update') {
        $.ajax({
            url: 'cart/update_cart.php',
            method: 'POST',
            data: {
                product_id: productId,
                quantity: quantity,
                action: action
            },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    updateCartCount(response.cart_count);
                    location.reload(); // Reload to show updated cart
                } else {
                    showAlert(response.message, 'danger');
                }
            },
            error: function() {
                showAlert('Error updating cart', 'danger');
            }
        });
    }

    function removeFromCart(productId) {
        if (confirm('Are you sure you want to remove this item?')) {
            $.ajax({
                url: 'cart/remove_cart.php',
                method: 'POST',
                data: {
                    product_id: productId
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        updateCartCount(response.cart_count);
                        if (response.cart_empty) {
                            location.reload(); // Reload to show empty cart
                        } else {
                            location.reload(); // Reload to show updated cart
                        }
                    } else {
                        showAlert(response.message, 'danger');
                    }
                },
                error: function() {
                    showAlert('Error removing item', 'danger');
                }
            });
        }
    }

    function showAlert(message, type) {
        const alertHtml = `
            <div class="alert alert-${type} alert-dismissible fade show" role="alert">
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        `;
        
        // Remove existing alerts
        $('.alert').not('.alert-dismissible').remove();
        
        // Add new alert at the top of the page
        $('body').prepend(alertHtml);
        
        // Auto-dismiss after 5 seconds
        setTimeout(() => {
            $('.alert').alert('close');
        }, 5000);
    }

    // Initialize cart count on page load
    document.addEventListener('DOMContentLoaded', function() {
        const cartCount = <?php echo $total_items; ?>;
        updateCartCount(cartCount);
    });
    </script>
</body>
</html>
