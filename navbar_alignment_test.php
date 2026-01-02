<?php
// Set page title
$page_title = "Navbar Alignment Test - eCommerce Store";

// Include header
require_once 'includes/header.php';
?>

<div class="container my-5">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h2 class="mb-0">
                <i class="fas fa-align-center me-2"></i>Navbar Alignment Test
            </h2>
        </div>
        <div class="card-body">
            
            <div class="alert alert-success">
                <h4>✅ Navbar Alignment Fixed!</h4>
                <p>Cart icon and user avatar should now be properly aligned.</p>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <h5>Alignment Fixes Applied:</h5>
                    <div class="card bg-light p-3">
                        <ul class="list-unstyled">
                            <li><i class="fas fa-wrench text-primary me-2"></i>Added <code>ms-auto</code> to right navbar</li>
                            <li><i class="fas fa-wrench text-primary me-2"></i>Added <code>d-flex align-items-center</code></li>
                            <li><i class="fas fa-wrench text-primary me-2"></i>Fixed cart icon alignment</li>
                            <li><i class="fas fa-wrench text-primary me-2"></i>Fixed user avatar alignment</li>
                        </ul>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <h5>Expected Navbar Layout:</h5>
                    <div class="card bg-light p-3">
                        <div class="text-center mb-3">
                            <strong>Desktop View:</strong>
                        </div>
                        <div class="d-flex justify-content-between align-items-center border p-2 rounded">
                            <span class="badge bg-primary">Brand</span>
                            <span class="badge bg-success">Home | Shop | Categories</span>
                            <span class="badge bg-info">Cart</span>
                            <span class="badge bg-warning">Avatar</span>
                        </div>
                        <div class="text-center mt-3">
                            <small>All elements should be horizontally aligned</small>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mt-4">
                <h5>Visual Test:</h5>
                <div class="alert alert-info">
                    <p class="mb-2">Look at the navbar above. You should see:</p>
                    <ul class="mb-0">
                        <li>🏪 <strong>Left:</strong> Brand + Main Navigation</li>
                        <li>🛒 <strong>Right:</strong> Cart Icon + User Avatar (aligned)</li>
                        <li>📏 <strong>Height:</strong> All elements at same level</li>
                        <li>📱 <strong>Mobile:</strong> Proper hamburger menu</li>
                    </ul>
                </div>
            </div>
            
            <div class="mt-4">
                <h5>CSS Changes Made:</h5>
                <div class="row">
                    <div class="col-md-6">
                        <h6>Flexbox Alignment:</h6>
                        <ul class="list-unstyled">
                            <li><code>.navbar-nav.ms-auto { margin-left: auto; }</code></li>
                            <li><code>.navbar-nav.d-flex { display: flex; align-items: center; }</code></li>
                            <li><code>.nav-item { display: flex; align-items: center; }</code></li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h6>Element Alignment:</h6>
                        <ul class="list-unstyled">
                            <li><code>.cart-icon-wrapper { display: flex; align-items: center; }</code></li>
                            <li><code>Proper vertical centering</code></li>
                            <li><code>Horizontal spacing</code></li>
                            <li><code>Responsive behavior</code></li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="mt-4">
                <h5>Test Different Screen Sizes:</h5>
                <div class="d-flex gap-2 flex-wrap">
                    <button class="btn btn-sm btn-outline-primary" onclick="window.resizeTo(1200, 800)">
                        <i class="fas fa-desktop me-1"></i>Desktop
                    </button>
                    <button class="btn btn-sm btn-outline-success" onclick="window.resizeTo(768, 800)">
                        <i class="fas fa-tablet me-1"></i>Tablet
                    </button>
                    <button class="btn btn-sm btn-outline-info" onclick="window.resizeTo(375, 800)">
                        <i class="fas fa-mobile me-1"></i>Mobile
                    </button>
                </div>
                <p class="text-muted small mt-2">Resize browser to test responsive alignment</p>
            </div>
            
            <div class="mt-4">
                <div class="alert alert-success">
                    <h6>🎯 Expected Result:</h6>
                    <ul class="mb-0">
                        <li>✅ Cart icon aligned with user avatar</li>
                        <li>✅ All elements at same vertical level</li>
                        <li>✅ Proper horizontal spacing</li>
                        <li>✅ Responsive behavior maintained</li>
                        <li>✅ Professional appearance</li>
                    </ul>
                </div>
            </div>
            
            <div class="mt-4">
                <div class="d-flex gap-2 flex-wrap">
                    <a href="index.php" class="btn btn-primary">
                        <i class="fas fa-home me-2"></i>Test Home
                    </a>
                    <a href="shop.php" class="btn btn-outline-primary">
                        <i class="fas fa-shopping-bag me-2"></i>Test Shop
                    </a>
                    <a href="cart.php" class="btn btn-outline-success">
                        <i class="fas fa-shopping-cart me-2"></i>Test Cart
                    </a>
                    <a href="dashboard.php" class="btn btn-outline-info">
                        <i class="fas fa-user me-2"></i>Test Dashboard
                    </a>
                </div>
            </div>
            
        </div>
    </div>
</div>

<?php
// Include footer
require_once 'includes/footer.php';
?>
