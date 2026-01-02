<?php
// Test Admin Dashboard
require_once '../config/db.php';

echo "<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard Test - eCommerce</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css' rel='stylesheet'>
    <style>
        body { background: #f8f9fa; }
        .container { max-width: 1000px; margin-top: 50px; }
        .card { border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.1); border-radius: 15px; }
        .card-header { border-radius: 15px 15px 0 0 !important; }
    </style>
</head>
<body>
    <div class='container'>
        <div class='card'>
            <div class='card-header bg-danger text-white'>
                <h3><i class='fas fa-tachometer-alt me-2'></i>Admin Dashboard Test</h3>
            </div>
            <div class='card-body'>";

try {
    // Test database connection
    echo "<h4><i class='fas fa-database me-2'></i>Database Connection</h4>";
    if ($mysqli->connect_error) {
        echo "<div class='alert alert-danger'>✗ Database connection failed: " . $mysqli->connect_error . "</div>";
        exit;
    }
    echo "<div class='alert alert-success'>✓ Database connection successful</div>";

    // Test dashboard queries
    echo "<h4><i class='fas fa-chart-bar me-2'></i>Dashboard Statistics Test</h4>";
    
    // Test total users
    $stmt = $mysqli->query("SELECT COUNT(*) as total_users FROM users WHERE role = 'user'");
    $total_users = $stmt->fetch_assoc()['total_users'];
    echo "<div class='alert alert-info'>✓ Total Users: $total_users</div>";
    
    // Test total products
    $stmt = $mysqli->query("SELECT COUNT(*) as total_products FROM products");
    $total_products = $stmt->fetch_assoc()['total_products'];
    echo "<div class='alert alert-info'>✓ Total Products: $total_products</div>";
    
    // Test total orders
    $stmt = $mysqli->query("SELECT COUNT(*) as total_orders FROM orders");
    $total_orders = $stmt->fetch_assoc()['total_orders'];
    echo "<div class='alert alert-info'>✓ Total Orders: $total_orders</div>";
    
    // Test recent users query
    echo "<h4><i class='fas fa-users me-2'></i>Recent Users Query Test</h4>";
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
    
    echo "<div class='alert alert-success'>✓ Recent users query successful (" . count($recent_users) . " users)</div>";
    
    if (!empty($recent_users)) {
        echo "<div class='card bg-light mb-3'>";
        echo "<div class='card-body'>";
        echo "<h6>Recent Users:</h6>";
        echo "<ul class='mb-0'>";
        foreach ($recent_users as $user) {
            echo "<li>" . htmlspecialchars($user['name']) . " (" . htmlspecialchars($user['email']) . ")</li>";
        }
        echo "</ul>";
        echo "</div>";
        echo "</div>";
    }
    
    // Test low stock products query
    echo "<h4><i class='fas fa-exclamation-triangle me-2'></i>Low Stock Products Query Test</h4>";
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
    
    echo "<div class='alert alert-success'>✓ Low stock products query successful (" . count($low_stock_products) . " products)</div>";
    
    if (!empty($low_stock_products)) {
        echo "<div class='card bg-light mb-3'>";
        echo "<div class='card-body'>";
        echo "<h6>Low Stock Products:</h6>";
        echo "<ul class='mb-0'>";
        foreach ($low_stock_products as $product) {
            echo "<li>" . htmlspecialchars($product['name']) . " (Stock: " . $product['stock'] . ")</li>";
        }
        echo "</ul>";
        echo "</div>";
        echo "</div>";
    } else {
        echo "<div class='alert alert-warning'>⚠ No products with low stock found</div>";
    }
    
    // Test recent orders query
    echo "<h4><i class='fas fa-shopping-cart me-2'></i>Recent Orders Query Test</h4>";
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
    
    echo "<div class='alert alert-success'>✓ Recent orders query successful (" . count($recent_orders) . " orders)</div>";
    
    if (!empty($recent_orders)) {
        echo "<div class='card bg-light mb-3'>";
        echo "<div class='card-body'>";
        echo "<h6>Recent Orders:</h6>";
        echo "<ul class='mb-0'>";
        foreach ($recent_orders as $order) {
            echo "<li>Order #" . $order['id'] . " - " . htmlspecialchars($order['customer_name'] ?? 'N/A') . " - $" . number_format($order['total_amount'], 2) . "</li>";
        }
        echo "</ul>";
        echo "</div>";
        echo "</div>";
    } else {
        echo "<div class='alert alert-warning'>⚠ No orders found</div>";
    }
    
    echo "<hr>";
    echo "<div class='alert alert-success'>";
    echo "<h5><i class='fas fa-check-circle me-2'></i>All Dashboard Tests Passed!</h5>";
    echo "<p>The admin dashboard queries are working correctly with mysqli.</p>";
    echo "</div>";
    
    echo "<div class='d-grid gap-2 d-md-flex justify-content-md-end'>";
    echo "<a href='dashboard.php' class='btn btn-danger'>";
    echo "<i class='fas fa-tachometer-alt me-2'></i>Go to Admin Dashboard";
    echo "</a>";
    echo "<a href='../index.php' class='btn btn-outline-secondary'>";
    echo "<i class='fas fa-home me-2'></i>Back to Website";
    echo "</a>";
    echo "</div>";
    
} catch (Exception $e) {
    echo "<div class='alert alert-danger'>Error: " . $e->getMessage() . "</div>";
}

echo "</div>
        </div>
    </div>
</body>
</html>";
?>
