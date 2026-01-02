<?php
// Set page title
$page_title = "Navbar Test - eCommerce Store";

// Include header
require_once 'includes/header.php';
?>

<div class="container my-5">
    <div class="card">
        <div class="card-header bg-gradient-primary text-white">
            <h2 class="mb-0">
                <i class="fas fa-bars me-2"></i>Navbar Visibility Test
            </h2>
        </div>
        <div class="card-body">
            
            <div class="alert alert-info">
                <h4>Navbar Test Results</h4>
                <p>If you can see the navbar above with all elements visible, the fix is working correctly.</p>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <h5>What to Check:</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <i class="fas fa-check text-success me-2"></i>
                            <strong>Navbar Brand:</strong> "eCommerce" with shopping bag icon
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-check text-success me-2"></i>
                            <strong>Navigation Links:</strong> Home, Shop, Categories
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-check text-success me-2"></i>
                            <strong>Categories Dropdown:</strong> Click to see categories
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-check text-success me-2"></i>
                            <strong>Cart Icon:</strong> Shopping cart with badge
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-check text-success me-2"></i>
                            <strong>User Avatar:</strong> Circular avatar with first letter
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-check text-success me-2"></i>
                            <strong>Mobile Menu:</strong> Hamburger icon on mobile
                        </li>
                    </ul>
                </div>
                
                <div class="col-md-6">
                    <h5>Test Navigation:</h5>
                    <div class="d-grid gap-2">
                        <a href="index.php" class="btn btn-primary">
                            <i class="fas fa-home me-2"></i>Test Home Page
                        </a>
                        <a href="shop.php" class="btn btn-outline-primary">
                            <i class="fas fa-shopping-bag me-2"></i>Test Shop Page
                        </a>
                        <a href="cart.php" class="btn btn-outline-success">
                            <i class="fas fa-shopping-cart me-2"></i>Test Cart Page
                        </a>
                        <a href="dashboard.php" class="btn btn-outline-info">
                            <i class="fas fa-user me-2"></i>Test Dashboard
                        </a>
                        <a href="contact.php" class="btn btn-outline-warning">
                            <i class="fas fa-envelope me-2"></i>Test Contact Page
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="mt-4">
                <h5>Troubleshooting:</h5>
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>If navbar is still not visible:</strong>
                    <ul class="mb-0 mt-2">
                        <li>Check browser console for CSS errors</li>
                        <li>Clear browser cache and refresh</li>
                        <li>Ensure all CSS files are loading properly</li>
                        <li>Check for JavaScript conflicts</li>
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
