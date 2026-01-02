<?php
// Set page title
$page_title = "My Dashboard - eCommerce Store";

// Include header first (this will start session and include db.php)
require_once 'includes/header.php';

// Include cart helper for cart functions
require_once 'cart_helper.php';

// Add dashboard-specific CSS
echo "<style>
    /* Dashboard specific text visibility fix */
    .card-header h5 { color: white !important; opacity: 1 !important; visibility: visible !important; }
    .card-title { color: #1f2937 !important; opacity: 1 !important; visibility: visible !important; }
    .btn i, .btn .fas, .btn .fa { opacity: 1 !important; visibility: visible !important; color: inherit !important; }
    .fa-user, .fa-shopping-bag, .fa-shopping-cart, .fa-sign-out-alt, .fa-dollar-sign { opacity: 1 !important; visibility: visible !important; }
    .text-muted { opacity: 0.8 !important; visibility: visible !important; color: #64748b !important; }
    .badge { opacity: 1 !important; visibility: visible !important; }
    .bg-primary .fa-user { color: white !important; opacity: 1 !important; }
    .text-primary .fa-shopping-bag, .text-success .fa-shopping-cart, .text-info .fa-dollar-sign { opacity: 1 !important; visibility: visible !important; }
</style>";

// Check if user is logged in
if (!isLoggedIn()) {
    $_SESSION['error_message'] = "Please login to access your dashboard";
    $_SESSION['redirect_url'] = 'dashboard.php';
    redirect('auth/login.php');
}

// Get user information using mysqli
$stmt = $mysqli->prepare("SELECT id, name, email, role, created_at FROM users WHERE id = ?");
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    // User not found, logout
    session_destroy();
    redirect('auth/login.php');
}

$user = $result->fetch_assoc();

// Get user's orders using mysqli
$stmt = $mysqli->prepare("
    SELECT o.*, COUNT(oi.id) as item_count 
    FROM orders o 
    LEFT JOIN order_items oi ON o.id = oi.order_id 
    WHERE o.user_id = ? 
    GROUP BY o.id 
    ORDER BY o.created_at DESC
");
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$orders_result = $stmt->get_result();
$orders = [];

while ($order = $orders_result->fetch_assoc()) {
    $orders[] = $order;
}

// Get cart summary
$cart_count = getCartCount();
$cart_total = getCartTotal();
?>

<div class="container my-5 dashboard-page">
    <div class="row">
        <!-- User Profile Section -->
        <div class="col-md-4">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-user me-2"></i>My Profile
                    </h5>
                </div>
                <div class="card-body text-center">
                    <div class="mb-3">
                        <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center" 
                             style="width: 80px; height: 80px;">
                            <i class="fas fa-user fa-2x"></i>
                        </div>
                    </div>
                    <h5><?php echo htmlspecialchars($user['name']); ?></h5>
                    <p class="text-muted"><?php echo htmlspecialchars($user['email']); ?></p>
                    <span class="badge bg-info">
                        <?php echo ucfirst($user['role']); ?>
                    </span>
                    <hr>
                    <div class="text-start">
                        <small class="text-muted">
                            <strong>Member Since:</strong><br>
                            <?php echo date('F j, Y', strtotime($user['created_at'])); ?>
                        </small>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h6 class="mb-0">Quick Actions</h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="shop.php" class="btn btn-outline-primary">
                            <i class="fas fa-shopping-bag me-2"></i>Continue Shopping
                        </a>
                        <a href="cart.php" class="btn btn-outline-secondary">
                            <i class="fas fa-shopping-cart me-2"></i>View Cart
                            <?php if ($cart_count > 0): ?>
                                <span class="badge bg-primary ms-1"><?php echo $cart_count; ?></span>
                            <?php endif; ?>
                        </a>
                        <a href="auth/logout.php" class="btn btn-outline-danger">
                            <i class="fas fa-sign-out-alt me-2"></i>Logout
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Dashboard Content -->
        <div class="col-md-8">
            <!-- Welcome Section -->
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h4>Welcome back, <?php echo htmlspecialchars($user['name']); ?>! 👋</h4>
                    <p class="text-muted">Here's what's happening with your account today.</p>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="card shadow-sm border-primary">
                        <div class="card-body text-center">
                            <i class="fas fa-shopping-bag fa-2x text-primary mb-2"></i>
                            <h3><?php echo count($orders); ?></h3>
                            <p class="text-muted mb-0">Total Orders</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm border-success">
                        <div class="card-body text-center">
                            <i class="fas fa-shopping-cart fa-2x text-success mb-2"></i>
                            <h3><?php echo $cart_count; ?></h3>
                            <p class="text-muted mb-0">Cart Items</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm border-info">
                        <div class="card-body text-center">
                            <i class="fas fa-dollar-sign fa-2x text-info mb-2"></i>
                            <h3>$<?php echo number_format($cart_total, 2); ?></h3>
                            <p class="text-muted mb-0">Cart Total</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Orders -->
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">
                            <i class="fas fa-list me-2"></i>Recent Orders
                        </h5>
                        <?php if (!empty($orders)): ?>
                            <small class="text-muted">
                                <a href="order_history.php" class="text-decoration-none">View All</a>
                            </small>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="card-body">
                    <?php if (empty($orders)): ?>
                        <!-- No Orders -->
                        <div class="text-center py-4">
                            <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">No orders yet</h5>
                            <p class="text-muted">Start shopping to see your order history here.</p>
                            <a href="shop.php" class="btn btn-primary">
                                <i class="fas fa-shopping-bag me-2"></i>Start Shopping
                            </a>
                        </div>
                    <?php else: ?>
                        <!-- Orders List -->
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Date</th>
                                        <th>Items</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach (array_slice($orders, 0, 5) as $order): ?>
                                        <tr>
                                            <td>
                                                <strong>#<?php echo str_pad($order['id'], 6, '0', STR_PAD_LEFT); ?></strong>
                                            </td>
                                            <td><?php echo date('M j, Y', strtotime($order['created_at'])); ?></td>
                                            <td><?php echo $order['item_count']; ?></td>
                                            <td>$<?php echo number_format($order['total_amount'], 2); ?></td>
                                            <td>
                                                <?php
                                                $status_class = match($order['status']) {
                                                    'pending' => 'warning',
                                                    'processing' => 'info',
                                                    'completed' => 'success',
                                                    'cancelled' => 'danger',
                                                    default => 'secondary'
                                                };
                                                ?>
                                                <span class="badge bg-<?php echo $status_class; ?>">
                                                    <?php echo ucfirst($order['status']); ?>
                                                </span>
                                            </td>
                                            <td>
                                                <a href="order_details.php?id=<?php echo $order['id']; ?>" 
                                                   class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        
                        <?php if (count($orders) > 5): ?>
                            <div class="text-center mt-3">
                                <a href="order_history.php" class="btn btn-outline-primary">
                                    View All Orders
                                </a>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
// Include footer
require_once 'includes/footer.php';
?>
