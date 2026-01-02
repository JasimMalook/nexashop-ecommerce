<?php
require_once '../config/db.php';

// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if admin is logged in
if (!isLoggedIn() || !isAdmin()) {
    $_SESSION['error_message'] = "Admin access required";
    redirect('admin_login.php');
}

// Get dashboard statistics using mysqli
$stmt = $mysqli->query("SELECT COUNT(*) as total_users FROM users WHERE role = 'user'");
$total_users = $stmt->fetch_assoc()['total_users'];

$stmt = $mysqli->query("SELECT COUNT(*) as total_products FROM products");
$total_products = $stmt->fetch_assoc()['total_products'];

$stmt = $mysqli->query("SELECT COUNT(*) as total_orders FROM orders");
$total_orders = $stmt->fetch_assoc()['total_orders'];

$stmt = $mysqli->query("SELECT SUM(total_amount) as total_revenue FROM orders WHERE status != 'cancelled'");
$result = $stmt->fetch_assoc();
$total_revenue = $result['total_revenue'] ?? 0;

// Get recent orders using mysqli
$stmt = $mysqli->query("
    SELECT o.*, u.name as customer_name 
    FROM orders o 
    LEFT JOIN users u ON o.user_id = u.id 
    ORDER BY o.created_at DESC 
    LIMIT 5
");
$recent_orders = [];

while ($order = $stmt->fetch_assoc()) {
    $recent_orders[] = $order;
}

// Get recent users
$stmt = $mysqli->query("
    SELECT id, name, email, created_at 
    FROM users 
    WHERE role = 'user' 
    ORDER BY created_at DESC 
    LIMIT 5
");
$recent_users = [];

while ($user = $stmt->fetch_assoc()) {
    $recent_users[] = $user;
}

// Get low stock products
$stmt = $mysqli->query("
    SELECT id, name, stock 
    FROM products 
    WHERE stock <= 10 
    ORDER BY stock ASC 
    LIMIT 5
");
$low_stock_products = [];

while ($product = $stmt->fetch_assoc()) {
    $low_stock_products[] = $product;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - ShopSphere</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- MDBootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../assets/css/style.css" rel="stylesheet">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Admin Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block admin-sidebar">
                <div class="position-sticky pt-3">
                    <h4 class="text-white text-center mb-4">Admin Panel</h4>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="dashboard.php">
                                <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="products.php">
                                <i class="fas fa-box me-2"></i> Products
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="categories.php">
                                <i class="fas fa-tags me-2"></i> Categories
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="orders.php">
                                <i class="fas fa-shopping-cart me-2"></i> Orders
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="users.php">
                                <i class="fas fa-users me-2"></i> Users
                            </a>
                        </li>
                        <li class="nav-item mt-4">
                            <a class="nav-link text-danger" href="../auth/logout.php">
                                <i class="fas fa-sign-out-alt me-2"></i> Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 admin-content">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Dashboard</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group me-2">
                            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
                        </div>
                    </div>
                </div>

                <!-- Statistics Cards -->
                <div class="row mb-4">
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="stats-card">
                            <div class="stats-icon text-primary mb-3">
                                <i class="fas fa-users fa-2x"></i>
                            </div>
                            <div class="stats-number"><?php echo $total_users; ?></div>
                            <div class="stats-label">Total Users</div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="stats-card">
                            <div class="stats-icon text-success mb-3">
                                <i class="fas fa-box fa-2x"></i>
                            </div>
                            <div class="stats-number"><?php echo $total_products; ?></div>
                            <div class="stats-label">Total Products</div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="stats-card">
                            <div class="stats-icon text-warning mb-3">
                                <i class="fas fa-shopping-cart fa-2x"></i>
                            </div>
                            <div class="stats-number"><?php echo $total_orders; ?></div>
                            <div class="stats-label">Total Orders</div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="stats-card">
                            <div class="stats-icon text-info mb-3">
                                <i class="fas fa-dollar-sign fa-2x"></i>
                            </div>
                            <div class="stats-number">$<?php echo number_format($total_revenue, 2); ?></div>
                            <div class="stats-label">Total Revenue</div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Recent Orders -->
                    <div class="col-lg-8 mb-4">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0">Recent Orders</h5>
                                <a href="orders.php" class="btn btn-sm btn-outline-primary">View All</a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Order ID</th>
                                                <th>Customer</th>
                                                <th>Amount</th>
                                                <th>Status</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (count($recent_orders) > 0): ?>
                                                <?php foreach ($recent_orders as $order): ?>
                                                    <tr>
                                                        <td>#<?php echo $order['id']; ?></td>
                                                        <td><?php echo htmlspecialchars($order['customer_name'] ?? 'N/A'); ?></td>
                                                        <td>$<?php echo number_format($order['total_amount'], 2); ?></td>
                                                        <td>
                                                            <span class="badge bg-<?php 
                                                                echo match($order['status']) {
                                                                    'pending' => 'warning',
                                                                    'processing' => 'info',
                                                                    'completed' => 'success',
                                                                    'cancelled' => 'danger',
                                                                    default => 'secondary'
                                                                };
                                                            ?>">
                                                                <?php echo ucfirst($order['status']); ?>
                                                            </span>
                                                        </td>
                                                        <td><?php echo date('M j, Y', strtotime($order['created_at'])); ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="5" class="text-center">No orders found</td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Users & Low Stock -->
                    <div class="col-lg-4">
                        <!-- Recent Users -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Recent Users</h5>
                            </div>
                            <div class="card-body">
                                <?php if (count($recent_users) > 0): ?>
                                    <?php foreach ($recent_users as $user): ?>
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="flex-shrink-0">
                                                <i class="fas fa-user-circle fa-2x text-muted"></i>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="mb-0"><?php echo htmlspecialchars($user['name']); ?></h6>
                                                <small class="text-muted"><?php echo htmlspecialchars($user['email']); ?></small>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <p class="text-muted text-center">No recent users</p>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Low Stock Alert -->
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Low Stock Alert</h5>
                            </div>
                            <div class="card-body">
                                <?php if (count($low_stock_products) > 0): ?>
                                    <?php foreach ($low_stock_products as $product): ?>
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <div>
                                                <h6 class="mb-0"><?php echo htmlspecialchars($product['name']); ?></h6>
                                                <small class="text-muted">Stock: <?php echo $product['stock']; ?></small>
                                            </div>
                                            <span class="badge bg-danger">Low</span>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <p class="text-muted text-center">All products in stock</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <!-- Custom JS -->
    <script src="../assets/js/script.js"></script>
</body>
</html>
