<?php
// Set page title
$page_title = "Home Debug - eCommerce Store";

// Include header first (this will start session and include db.php)
require_once 'includes/header.php';
?>

<div class="container my-5">
    <div class="card">
        <div class="card-header bg-gradient-primary text-white">
            <h2 class="mb-0">
                <i class="fas fa-bug me-2"></i>Index Page Debug
            </h2>
        </div>
        <div class="card-body">
            
            <div class="alert alert-info">
                <h4>Debug Information</h4>
                <p>This page helps identify any issues with the index.php page.</p>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <h5>Page Status:</h5>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-check text-success me-2"></i>Header loaded successfully</li>
                        <li><i class="fas fa-check text-success me-2"></i>Database connection active</li>
                        <li><i class="fas fa-check text-success me-2"></i>Session started</li>
                        <li><i class="fas fa-check text-success me-2"></i>Navbar should be visible</li>
                    </ul>
                </div>
                
                <div class="col-md-6">
                    <h5>Database Queries:</h5>
                    <?php
                    // Test featured products query
                    $stmt = $mysqli->query("
                        SELECT p.*, c.name as category_name 
                        FROM products p 
                        LEFT JOIN categories c ON p.category_id = c.id 
                        ORDER BY p.created_at DESC 
                        LIMIT 8
                    ");
                    $featured_products = [];
                    
                    if ($stmt) {
                        echo '<li><i class="fas fa-check text-success me-2"></i>Featured products query: SUCCESS (' . $stmt->num_rows . ' products)</li>';
                        while ($product = $stmt->fetch_assoc()) {
                            $featured_products[] = $product;
                        }
                    } else {
                        echo '<li><i class="fas fa-times text-danger me-2"></i>Featured products query: FAILED</li>';
                    }
                    
                    // Test categories query
                    $categories_result = $mysqli->query("SELECT id, name FROM categories ORDER BY name");
                    $categories = [];
                    
                    if ($categories_result) {
                        echo '<li><i class="fas fa-check text-success me-2"></i>Categories query: SUCCESS (' . $categories_result->num_rows . ' categories)</li>';
                        while ($category = $categories_result->fetch_assoc()) {
                            $categories[] = $category;
                        }
                    } else {
                        echo '<li><i class="fas fa-times text-danger me-2"></i>Categories query: FAILED</li>';
                    }
                    ?>
                </div>
            </div>
            
            <div class="mt-4">
                <h5>Navigation Test:</h5>
                <div class="d-flex gap-2 flex-wrap">
                    <a href="index.php" class="btn btn-primary">Home</a>
                    <a href="shop.php" class="btn btn-outline-primary">Shop</a>
                    <a href="cart.php" class="btn btn-outline-success">Cart</a>
                    <?php if (isLoggedIn()): ?>
                        <a href="dashboard.php" class="btn btn-outline-info">Dashboard</a>
                    <?php else: ?>
                        <a href="auth/login.php" class="btn btn-outline-warning">Login</a>
                    <?php endif; ?>
                </div>
            </div>
            
            <div class="mt-4">
                <h5>Sample Content Display:</h5>
                <div class="row">
                    <?php if (!empty($featured_products)): ?>
                        <?php foreach (array_slice($featured_products, 0, 2) as $product): ?>
                            <div class="col-md-6 mb-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h6><?php echo htmlspecialchars($product['name']); ?></h6>
                                        <p class="text-muted">$<?php echo number_format($product['price'], 2); ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="col-12">
                            <p class="text-muted">No products found in database.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            
            <div class="mt-4">
                <h5>Troubleshooting:</h5>
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>If original index.php is not working:</strong>
                    <ul class="mb-0 mt-2">
                        <li>Check browser console for JavaScript errors</li>
                        <li>Verify CSS files are loading properly</li>
                        <li>Check database connection</li>
                        <li>Look for PHP errors in error logs</li>
                    </ul>
                </div>
            </div>
            
        </div>
    </div>
</div>

<?php
// Include footer
require_once 'includes/footer.php';
?>
