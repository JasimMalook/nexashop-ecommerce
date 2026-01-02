<?php
// Set page title
$page_title = "Checkout";

// Include header first (this will start session and include db.php)
require_once 'includes/header.php';

// Check if user is logged in
if (!isLoggedIn()) {
    $_SESSION['error_message'] = "Please login to proceed with checkout";
    $_SESSION['redirect_url'] = 'checkout.php';
    redirect('auth/login.php');
}

// Check if cart is empty
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    $_SESSION['error_message'] = "Your cart is empty. Add some products before checkout.";
    redirect('shop.php');
}

// Get cart items and calculate totals using new cart structure
$cart_items = [];
$total_amount = 0;

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
        'image' => $item['image'],
        'subtotal' => $subtotal
    ];
}

// Calculate totals
$subtotal = $total_amount;
$tax = $subtotal * 0.1; // 10% tax
$shipping = $subtotal > 100 ? 0 : 10; // Free shipping over $100
$total = $subtotal + $tax + $shipping;

// Get user information using mysqli (only existing columns)
$stmt = $mysqli->prepare("SELECT id, name, email, role, created_at FROM users WHERE id = ?");
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Process checkout
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $billing_name = sanitize($_POST['billing_name'] ?? '');
    $billing_email = sanitize($_POST['billing_email'] ?? '');
    $billing_phone = sanitize($_POST['billing_phone'] ?? '');
    $billing_address = sanitize($_POST['billing_address'] ?? '');
    $billing_city = sanitize($_POST['billing_city'] ?? '');
    $billing_state = sanitize($_POST['billing_state'] ?? '');
    $billing_zip = sanitize($_POST['billing_zip'] ?? '');
    $payment_method = sanitize($_POST['payment_method'] ?? 'cod');
    
    // Validation
    $errors = [];
    
    if (empty($billing_name)) {
        $errors[] = "Full name is required";
    }
    
    if (empty($billing_email)) {
        $errors[] = "Email is required";
    } elseif (!filter_var($billing_email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }
    
    if (empty($billing_phone)) {
        $errors[] = "Phone number is required";
    }
    
    if (empty($billing_address)) {
        $errors[] = "Address is required";
    }
    
    if (empty($billing_city)) {
        $errors[] = "City is required";
    }
    
    if (empty($billing_state)) {
        $errors[] = "State is required";
    }
    
    if (empty($billing_zip)) {
        $errors[] = "ZIP code is required";
    }
    
    // Process order if no errors
    if (empty($errors)) {
        try {
            // Start transaction
            $mysqli->begin_transaction();
            
            // Create order
            $stmt = $mysqli->prepare("INSERT INTO orders (user_id, total_amount, status) VALUES (?, ?, 'pending')");
            $stmt->bind_param("id", $_SESSION['user_id'], $total);
            $stmt->execute();
            $order_id = $mysqli->insert_id;
            
            // Add order items
            foreach ($cart_items as $item) {
                $stmt = $mysqli->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("iiid", $order_id, $item['id'], $item['quantity'], $item['price']);
                $stmt->execute();
                
                // Update product stock
                $stmt = $mysqli->prepare("UPDATE products SET stock = stock - ? WHERE id = ?");
                $stmt->bind_param("ii", $item['quantity'], $item['id']);
                $stmt->execute();
            }
            
            // Commit transaction
            $mysqli->commit();
            
            // Clear cart
            unset($_SESSION['cart']);
            unset($_SESSION['cart_count']);
            unset($_SESSION['cart_total']);
            
            // Redirect to order confirmation
            $_SESSION['success_message'] = "Order placed successfully!";
            redirect('order_confirmation.php?order_id=' . $order_id);
            
        } catch (Exception $e) {
            $mysqli->rollback();
            $errors[] = "Order processing failed. Please try again.";
            error_log("Checkout error: " . $e->getMessage());
        }
    }
}
?>

<div class="container my-5">
    <div class="row">
        <div class="col-lg-8">
            <!-- Billing Information -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0">
                        <i class="fas fa-credit-card me-2"></i>Billing Information
                    </h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="checkout.php">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="billing_name" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="billing_name" name="billing_name" 
                                       value="<?php echo htmlspecialchars($billing_name ?? $user['name'] ?? ''); ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="billing_email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="billing_email" name="billing_email" 
                                       value="<?php echo htmlspecialchars($billing_email ?? $user['email'] ?? ''); ?>" required>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="billing_phone" class="form-label">Phone</label>
                            <input type="tel" class="form-control" id="billing_phone" name="billing_phone" 
                                   value="<?php echo htmlspecialchars($billing_phone ?? ''); ?>" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="billing_address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="billing_address" name="billing_address" 
                                   value="<?php echo htmlspecialchars($billing_address ?? ''); ?>" required>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="billing_city" class="form-label">City</label>
                                <input type="text" class="form-control" id="billing_city" name="billing_city" 
                                       value="<?php echo htmlspecialchars($billing_city ?? ''); ?>" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="billing_state" class="form-label">State</label>
                                <input type="text" class="form-control" id="billing_state" name="billing_state" 
                                       value="<?php echo htmlspecialchars($billing_state ?? ''); ?>" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="billing_zip" class="form-label">ZIP Code</label>
                                <input type="text" class="form-control" id="billing_zip" name="billing_zip" 
                                       value="<?php echo htmlspecialchars($billing_zip ?? ''); ?>" required>
                            </div>
                        </div>
                        
                        <h6 class="mt-4 mb-3">Payment Method</h6>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="payment_method" id="credit_card" value="credit_card" required>
                                    <label class="form-check-label" for="credit_card">
                                        <i class="fas fa-credit-card me-2"></i>Credit Card
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="payment_method" id="debit_card" value="debit_card">
                                    <label class="form-check-label" for="debit_card">
                                        <i class="fas fa-credit-card me-2"></i>Debit Card
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="payment_method" id="paypal" value="paypal">
                                    <label class="form-check-label" for="paypal">
                                        <i class="fab fa-paypal me-2"></i>PayPal
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                            <a href="cart.php" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Back to Cart
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-lock me-2"></i>Place Order
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Order Summary -->
        <div class="col-lg-4">
            <div class="card shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0">Order Summary</h5>
                </div>
                <div class="card-body">
                    <!-- Cart Items -->
                    <div class="mb-3">
                        <?php foreach ($cart_items as $item): ?>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div>
                                    <h6 class="mb-0"><?php echo htmlspecialchars($item['name']); ?></h6>
                                    <small class="text-muted">Qty: <?php echo $item['quantity']; ?></small>
                                </div>
                                <span>$<?php echo number_format($item['subtotal'], 2); ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    
                    <hr>
                    
                    <!-- Totals -->
                    <div class="d-flex justify-content-between mb-2">
                        <span>Subtotal:</span>
                        <span>$<?php echo number_format($subtotal, 2); ?></span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Tax (10%):</span>
                        <span>$<?php echo number_format($tax, 2); ?></span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Shipping:</span>
                        <span>
                            <?php if ($shipping == 0): ?>
                                <span class="text-success">FREE</span>
                            <?php else: ?>
                                $<?php echo number_format($shipping, 2); ?>
                            <?php endif; ?>
                        </span>
                    </div>
                    <?php if ($shipping > 0): ?>
                        <small class="text-muted d-block mb-3">
                            <i class="fas fa-truck me-1"></i>
                            Free shipping on orders over $100
                        </small>
                    <?php endif; ?>
                    <hr>
                    <div class="d-flex justify-content-between mb-3">
                        <h5>Total:</h5>
                        <h5 class="text-primary">$<?php echo number_format($total, 2); ?></h5>
                    </div>
                    
                    <!-- Security Info -->
                    <div class="alert alert-info">
                        <h6><i class="fas fa-shield-alt me-2"></i>Secure Checkout</h6>
                        <small class="text-muted">
                            Your payment information is encrypted and secure. We never store your credit card details.
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
// Include footer
require_once 'includes/footer.php';
?>
