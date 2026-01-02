<?php
// Set page title
$page_title = "Shopping Cart - ShopSphere";

// Include header first (this will start session and include db.php)
require_once 'includes/header.php';

// Check if user is logged in
if (!isLoggedIn()) {
    $_SESSION['error_message'] = "Please login to view your cart";
    $_SESSION['redirect_url'] = 'cart.php';
    redirect('auth/login.php');
}

// Initialize cart from session using new cart structure
$cart_items = [];
$total_amount = 0;

if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $product_id => $item) {
        $quantity = $item['quantity'];
        $price = $item['price'];
        $subtotal = $price * $quantity;
        $total_amount += $subtotal;
        
        $cart_items[] = [
            'id' => $product_id,
            'name' => $item['name'],
            'price' => $price,
            'quantity' => $quantity,
            'subtotal' => $subtotal,
            'image' => $item['image'],
            'stock' => $item['stock']
        ];
    }
}

// Calculate totals
$subtotal = $total_amount;
$tax = $subtotal * 0.1; // 10% tax
$shipping = $subtotal > 100 ? 0 : 10; // Free shipping over $100
$total = $subtotal + $tax + $shipping;
?>

<section class="py-4 bg-white">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h4 class="mb-0">
                <i class="fas fa-shopping-cart me-2"></i>Shopping Cart
                <?php if (!empty($cart_items)): ?>
                    <span class="badge bg-primary ms-2"><?php echo count($cart_items); ?> items</span>
                <?php endif; ?>
            </h4>
            <a href="shop.php" class="btn btn-outline-primary">
                <i class="fas fa-arrow-left me-2"></i>Continue Shopping
            </a>
        </div>
    </div>
</section>

<!-- Cart Content -->
<section class="py-5">
    <div class="container">
        <?php if (empty($cart_items)): ?>
            <!-- Empty Cart -->
            <div class="card shadow-soft rounded-soft">
                <div class="card-body text-center py-5">
                    <div class="empty-cart-illustration mb-4">
                        <i class="fas fa-shopping-cart fa-5x text-muted"></i>
                    </div>
                    <h4 class="text-muted mb-3">Your cart is empty</h4>
                    <p class="text-muted mb-4">Looks like you haven't added any products to your cart yet.</p>
                    <a href="shop.php" class="btn btn-primary btn-lg shadow-soft">
                        <i class="fas fa-shopping-bag me-2"></i>Continue Shopping
                    </a>
                </div>
            </div>
        <?php else: ?>
            <div class="row">
                <!-- Cart Items -->
                <div class="col-lg-8">
                    <div class="card shadow-soft rounded-soft">
                        <div class="card-header bg-white">
                            <h6 class="mb-0 fw-bold">Cart Items</h6>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Product</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($cart_items as $item): ?>
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <img src="assets/images/products/<?php echo htmlspecialchars($item['image']); ?>" 
                                                             alt="<?php echo htmlspecialchars($item['name']); ?>" 
                                                             class="me-3 rounded-soft" 
                                                             style="width: 60px; height: 60px; object-fit: cover;">
                                                        <div>
                                                            <h6 class="mb-1"><?php echo htmlspecialchars($item['name']); ?></h6>
                                                            <small class="text-muted">In stock: <?php echo $item['stock']; ?></small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="fw-bold text-primary">$<?php echo number_format($item['price'], 2); ?></span>
                                                </td>
                                                <td>
                                                    <div class="quantity-control">
                                                        <input type="number" name="quantity[<?php echo $item['id']; ?>]" 
                                                               value="<?php echo $item['quantity']; ?>" 
                                                               min="1" max="<?php echo $item['stock']; ?>" 
                                                               class="form-control form-control-sm">
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="fw-bold">$<?php echo number_format($item['subtotal'], 2); ?></span>
                                                </td>
                                                <td>
                                                    <form method="POST" action="cart.php" class="d-inline">
                                                        <input type="hidden" name="product_id" value="<?php echo $item['id']; ?>">
                                                        <button type="submit" name="remove_item" class="btn btn-sm btn-outline-danger">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            
                            <div class="d-flex justify-content-between align-items-center p-3 border-top">
                                <button type="submit" name="update_cart" class="btn btn-primary shadow-soft">
                                    <i class="fas fa-sync"></i> Update Cart
                                </button>
                                <form method="POST" action="cart.php" class="d-inline">
                                    <button type="submit" name="clear_cart" class="btn btn-outline-danger" 
                                            onclick="return confirm('Are you sure you want to clear your cart?')">
                                        <i class="fas fa-trash"></i> Clear Cart
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="col-lg-4">
                    <div class="card shadow-soft rounded-soft">
                        <div class="card-header bg-white">
                            <h6 class="mb-0 fw-bold">Order Summary</h6>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-3">
                                <span>Subtotal</span>
                                <span class="fw-bold">$<?php echo number_format($subtotal, 2); ?></span>
                            </div>
                            
                            <div class="d-flex justify-content-between mb-3">
                                <span>Tax (10%)</span>
                                <span class="fw-bold">$<?php echo number_format($tax, 2); ?></span>
                            </div>
                            
                            <div class="d-flex justify-content-between mb-3">
                                <span>Shipping</span>
                                <span class="fw-bold">
                                    <?php echo $shipping == 0 ? 'FREE' : '$' . number_format($shipping, 2); ?>
                                </span>
                            </div>
                            
                            <?php if ($shipping == 0): ?>
                                <div class="alert alert-success py-2 mb-3">
                                    <small><i class="fas fa-truck me-1"></i> Free shipping on orders over $100!</small>
                                </div>
                            <?php endif; ?>
                            
                            <hr>
                            
                            <div class="d-flex justify-content-between mb-4">
                                <h6 class="mb-0">Total</h6>
                                <h5 class="text-primary mb-0">$<?php echo number_format($total, 2); ?></h5>
                            </div>
                            
                            <a href="checkout.php" class="btn btn-success w-100 btn-lg shadow-soft">
                                <i class="fas fa-lock me-2"></i>Proceed to Checkout
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>

    <!-- JavaScript for Cart Functionality -->
    <script>
    // showAlert function definition
    function showAlert(message, type) {
        const alertHtml = `
            <div class="alert alert-${type} alert-dismissible fade show" role="alert">
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        `;
        
        // Remove existing alerts
        document.querySelectorAll('.alert').forEach(alert => alert.remove());
        
        // Add new alert
        const alertContainer = document.createElement('div');
        alertContainer.innerHTML = alertHtml;
        document.body.appendChild(alertContainer);
        
        // Auto-remove after 5 seconds
        setTimeout(() => {
            alertContainer.remove();
        }, 5000);
    }
    
    </script>

<?php
// Include footer
require_once 'includes/footer.php';
?>
