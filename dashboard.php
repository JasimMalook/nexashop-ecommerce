<?php
// Set page title
$page_title = "My Dashboard - eCommerce Store";

// Include header first (this will start session and include db.php)
require_once 'includes/header.php';

// Include cart helper for cart functions
require_once 'cart_helper.php';

// Add dashboard-specific CSS
echo "<style>
    /* Modern Dashboard Styles */
    .dashboard-page {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        padding: 2rem 0;
    }
    
    .dashboard-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border: none;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .dashboard-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
    }
    
    .profile-avatar {
        width: 100px;
        height: 100px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
    }
    
    .profile-avatar i {
        color: white;
        font-size: 2.5rem;
    }
    
    .stat-card {
        background: white;
        border-radius: 15px;
        padding: 1.5rem;
        text-align: center;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        border-left: 4px solid transparent;
    }
    
    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
    }
    
    .stat-card.primary {
        border-left-color: #667eea;
    }
    
    .stat-card.success {
        border-left-color: #10b981;
    }
    
    .stat-card.info {
        border-left-color: #3b82f6;
    }
    
    .stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        font-size: 1.5rem;
    }
    
    .stat-icon.primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }
    
    .stat-icon.success {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
    }
    
    .stat-icon.info {
        background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        color: white;
    }
    
    .stat-number {
        font-size: 2rem;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 0.5rem;
    }
    
    .stat-label {
        color: #6b7280;
        font-size: 0.9rem;
        margin-bottom: 0;
    }
    
    .welcome-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 15px;
        padding: 2rem;
        box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
    }
    
    .welcome-card h4 {
        font-size: 1.8rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }
    
    .action-btn {
        border-radius: 10px;
        padding: 0.75rem 1rem;
        font-weight: 500;
        transition: all 0.3s ease;
        border: none;
    }
    
    .action-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }
    
    .orders-table {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
    }
    
    .orders-table .table {
        margin-bottom: 0;
    }
    
    .orders-table th {
        background: #f8fafc;
        border: none;
        padding: 1rem;
        font-weight: 600;
        color: #374151;
    }
    
    .orders-table td {
        padding: 1rem;
        border-top: 1px solid #f3f4f6;
        vertical-align: middle;
    }
    
    .badge-status {
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 500;
    }
    
    .user-name {
        font-size: 1.3rem;
        font-weight: 600;
        color: #1f2937;
        margin-bottom: 0.5rem;
    }
    
    .user-email {
        color: #6b7280;
        margin-bottom: 1rem;
    }
    
    .card-header-custom {
        background: white;
        border-bottom: 1px solid #f3f4f6;
        padding: 1.25rem;
        border-radius: 15px 15px 0 0 !important;
    }
    
    .card-header-custom h5, .card-header-custom h6 {
        margin: 0;
        color: #1f2937;
        font-weight: 600;
    }
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
            <div class="dashboard-card mb-4">
                <div class="card-body text-center p-4">
                    <div class="profile-avatar">
                        <i class="fas fa-user"></i>
                    </div>
                    <h5 class="user-name"><?php echo htmlspecialchars($user['name']); ?></h5>
                    <p class="user-email"><?php echo htmlspecialchars($user['email']); ?></p>
                    <span class="badge bg-primary badge-status">
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
            <div class="dashboard-card">
                <div class="card-header-custom">
                    <h6>Quick Actions</h6>
                </div>
                <div class="card-body p-4">
                    <div class="d-grid gap-3">
                        <a href="shop.php" class="btn btn-primary action-btn">
                            <i class="fas fa-shopping-bag me-2"></i>Continue Shopping
                        </a>
                        <a href="cart.php" class="btn btn-success action-btn">
                            <i class="fas fa-shopping-cart me-2"></i>View Cart
                            <?php if ($cart_count > 0): ?>
                                <span class="badge bg-light text-primary ms-1"><?php echo $cart_count; ?></span>
                            <?php endif; ?>
                        </a>
                        <a href="auth/logout.php" class="btn btn-outline-danger action-btn">
                            <i class="fas fa-sign-out-alt me-2"></i>Logout
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Dashboard Content -->
        <div class="col-md-8">
            <!-- Welcome Section -->
            <div class="welcome-card mb-4">
                <div class="card-body">
                    <h4>Welcome back, <?php echo htmlspecialchars($user['name']); ?>! 👋</h4>
                    <p class="mb-0">Here's what's happening with your account today.</p>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="stat-card primary">
                        <div class="stat-icon primary">
                            <i class="fas fa-shopping-bag"></i>
                        </div>
                        <div class="stat-number"><?php echo count($orders); ?></div>
                        <div class="stat-label">Total Orders</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card success">
                        <div class="stat-icon success">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <div class="stat-number"><?php echo $cart_count; ?></div>
                        <div class="stat-label">Cart Items</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card info">
                        <div class="stat-icon info">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                        <div class="stat-number">$<?php echo number_format($cart_total, 2); ?></div>
                        <div class="stat-label">Cart Total</div>
                    </div>
                </div>
            </div>

            <!-- Recent Orders -->
            <div class="orders-table">
                <div class="card-header-custom">
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
                <div class="card-body p-0">
                    <?php if (empty($orders)): ?>
                        <!-- No Orders -->
                        <div class="text-center py-5">
                            <div class="stat-icon info mb-3">
                                <i class="fas fa-box-open"></i>
                            </div>
                            <h5 class="text-muted">No orders yet</h5>
                            <p class="text-muted mb-4">Start shopping to see your order history here.</p>
                            <a href="shop.php" class="btn btn-primary action-btn">
                                <i class="fas fa-shopping-bag me-2"></i>Start Shopping
                            </a>
                        </div>
                    <?php else: ?>
                        <!-- Orders List -->
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
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
                                            <td>
                                                <?php echo date('M j, Y', strtotime($order['created_at'])); ?>
                                            </td>
                                            <td>
                                                <span class="badge bg-primary badge-status">
                                                    <?php echo $order['item_count']; ?> items
                                                </span>
                                            </td>
                                            <td>
                                                <strong>$<?php echo number_format($order['total_amount'], 2); ?></strong>
                                            </td>
                                            <td>
                                                <span class="badge bg-<?php echo $order['status'] == 'delivered' ? 'success' : ($order['status'] == 'processing' ? 'warning' : 'info'); ?> badge-status">
                                                    <?php echo ucfirst($order['status']); ?>
                                                </span>
                                            </td>
                                            <td>
                                                <a href="order_details.php?id=<?php echo $order['id']; ?>" class="btn btn-sm btn-outline-primary action-btn">
                                                    <i class="fas fa-eye"></i> View
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
